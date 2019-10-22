<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repository\Users\UsersModel;
use App\Repository\Users\UsersRepository;
use App\Repository\Role\RoleRepository;
use App\Repository\Role\RoleModel;
use Auth;
use Entrust;
use DB;
use Alert;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersModel $userModel)
    {
        if(Auth::user()->can('view-user')){
            $users = $userModel->orderBy('created_at','desc')->paginate(10);
            return view('admin.user.user',compact('users'));
        }
        return view('error.404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('create-user'))
        {
            return view('admin.user.create_user');
        }
        return view('error.404');
    }

    private function formatUsers($params)
    {
        $params['date_of_birth'] = date('Y-m-d H:i:s', strtotime($params['date_of_birth']));

        return $params;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UsersRepository $userRepository, RoleRepository $roleRepository)
    {   
        $params = $request->all();
        $params = $this->formatUsers($params);
        $role = $roleRepository->find(1);
        if ($request->hasFile('avarta')) {
            $files =$request->file('avarta');
            $filesName = $files->getClientOriginalName();
            $file=$files->move('uploads/', $filesName);
        }

        $params['avarta'] = isset($filesName) ? $filesName : '';
        $user = $userRepository->createUser($params);

        $user->roles()->attach($role->id);
        $user->save();

        $notification = array(
            'message'       =>  'Bạn đã tạo mới 1 user!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('user.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, UsersRepository $userRepository)
    {
        if (Auth::user()->can('edit-user')) {
            $user = $userRepository->find($id);
            return view('admin.user.edit_user',compact('user'));
        }
        return view('error.404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id, UsersRepository $userRepository)
    {
        $params = $request->all();
        $params = $this->formatUsers($params);
        $users = $userRepository->find($id);
        $filename = $users->avarta;
        if ($request->hasFile('avarta')) {
            $files =$request->file('avarta');
            $filesName = $files->getClientOriginalName();
            $file=$files->move('uploads/', $filesName);
            $params['avarta'] = $filesName;
            $user = $userRepository->updateUser($params,$id);
        }else{
            $params['avarta'] = $filename;
            $user = $userRepository->updateUser($params,$id);
        }
        $users->save();
        
        
        $notification = array(
            'message'       =>  'Bạn đã cập nhật 1 user!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('user.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, UsersRepository $userRepository)
    {
        $user = $userRepository->delete($id);
        return response()->json([
            'msg'   =>  'User deleted',
            'status'    =>  'Success'
        ]);
    }

    public function getInfoUser($id, UsersRepository $userRepository){
        if (Auth::check()) {
            $user = $userRepository->find($id);
            if ($user->gender == 1) {
                $user->gender = "Nam";
            } else{
                $user->gender = "Nữ";
            }

            if ($user->status == 0) {
                $user->status = "Chưa xác nhận";
            } else{
                $user->status = "Đã xác nhận";
            }
            return view('admin.user.information_admin',compact('user'));
        }

    }

    public function loadRole($id, UsersRepository $userRepository, RoleRepository $roleRepository){
        if(Auth::user()->can('show-list-role'))
        {
            $user = $userRepository->find($id);
            $urs = DB::table('role_user')->where('user_id',$user->id)->get();
            $roles = $roleRepository->getList(20);
            return view('admin.user.load-role',compact(['roles','user','urs'])); 
        }
        return view('error.404');
        
    }

    public function pickRole(Request $request,$id, UsersModel $userModel, RoleRepository $roleRepository)
    {
        $user = $userModel->where('id',$request['user_id'])->first();
        $role = $roleRepository->find($id);
        $user->roles()->attach($role->id);
        $notification = array(
            'message'       =>  'Bạn đã active 1 role!',
            'alert-type'    =>  'success',
        );
        return response()->json([
            'success' => true,
            'value' =>  $role->id,
        ]);
    }

    public function unPickRole(Request $request,$id, UsersModel $userModel, RoleRepository $roleRepository){
        $user = $userModel->where('id',$request['user_id'])->first();
        $role = $roleRepository->find($id);
        $user->roles()->detach($role->id);
        return response()->json([
            'success' => true,
            'value' =>  $role->id,
        ]);
    }

    public function activeUser($id, UsersRepository $userRepository){
        $user = $userRepository->find($id);
        if ($user->status == 0) {
            $user->update([
                'status' => 1,
            ]);
        } else {
            $user->update([
                'status' => 0,
            ]);
        }
        $notification = array(
            'message'       =>  'Bạn đã active 1 user!',
            'alert-type'    =>  'success',
        );
        return response()->json([
            'success' => $user->save(),
            'value' =>  $user->status,
        ]);
    }

    public function search(Request $request, UsersModel $userModel){
        $output = [];
        $checked = "";
            // tìm kiếm theo tên.
            $searchNames = $userModel->where('name','like','%'.$request->searchUser.'%')->get();
                foreach ($searchNames as $searchName) {
                   // $output[]= ['name'=>$searchName->name,'id'=>$searchName->id];
                   if ($searchName->status == 0) {
                       $checked = "";
                   }
                   else{
                    $checked = "checked";
                   }
                   $output[] = '<tr>'.
                               '<td>'.$searchName->id.'</td>'.
                               '<td>'.$searchName->name.'</td>'.
                               '<td>'.$searchName->address.'</td>'.
                               '<td>'.$searchName->email.'</td>'.
                               '<td>'.$searchName->phone.'</td>'.
                               '<td>'.$searchName->login_name.'</td>'.
                               '<td>'.'<a href = "/pick-role/'.$searchName->id.'" class="btn btn-info">'.'<i class="fa fa-list-alt" aria-hidden="true"></i> List role</a></td>'.
                               '<td>'.'<a href = "/user/'.$searchName->id.'/edit" class="btn btn-warning">'.'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>'.
                               '<td>'.'<form action = "/user/'.$searchName->id.'" method = "POST">'.'<input type="hidden" name="_token" value="a9mT94TgIWDc7c6o15XsJZs9tR0clQ34J9dJxM1I">'.'<input type="hidden" name="_method" value="DELETE">'.'<button type="submit" class="btn btn-danger" onclick="return confirm("Bạn có chắc muốn xóa thành viên này khỏi danh sách?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>'.
                                '<td>'.'<div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;"><input type="hidden" name="id" class="user_id" value="'.$searchName->id.'">'.'<input type="checkbox" name="status" class="active-user" data-user-id="'.$searchName->id.'" '.$checked.'><div class="state p-success"><i class="icon fa fa-check"></i><label></label></div></div>'.
                               '</tr>';
                }
                return response()->json($output);
    }

    public function searchRole(Request $request, RoleModel $roleModel, UsersRepository $userRepository,$id){
        $output = [];
        $checked="";
        $user = $userRepository->find($id);
        $searchNameRoles = $roleModel->where('name','like','%'.$request->searchRole.'%')->get();
        foreach ($searchNameRoles as $searchNameRole) {
           $output[] = '<tr>'.
                       '<td>'.$searchNameRole->id.'</td>'.
                       '<td>'.$searchNameRole->name.'</td>'.
                       '<td>'.$searchNameRole->display_name.'</td>'.
                       '<td>'.$searchNameRole->description.'</td>'.
                       '<td>'.'<input type="hidden" name="user_id" class="user_id" value="'.$user->id.'">'.'<div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;"><input type="checkbox" name="active" class="active-role" data-role-id="'.$searchNameRole->id.'" '.$checked.'><div class="state p-success"><i class="icon fa fa-check"></i><label></label></div></div>'.'<input type="hidden" name="role_id" id="role_id" value="'.$searchNameRole->id.'">'.
                       '</tr>';
        }
        return response()->json($output);
    }

    public function viewChangePassword($id){
        return view('admin.user.change_password');
    }
    public function changePassword(Request $request, $id, UsersModel $userModel){
        $user = $userModel->find($id)->update(['password'  =>  bcrypt($request['password_new'])]);
        $notification = array(
            'message'       =>  'Bạn đã thay đổi mật khẩu thành công!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('informationUser',$id)->with($notification);
    }
    public function backPage(){
        return redirect()->route('user.index');
    }
}
