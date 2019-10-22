<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repository\Role\RoleRepository;
use App\Repository\Permission\PermissionRepository;
use App\Repository\Permission\PermissionModel;
use App\Repository\Role\RoleModel;
use DB;
use Entrust;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleModel $roleModel)
    {
        if(Auth::user()->can('view-role')){
            $roles = $roleModel->orderBy('created_at','desc')->paginate(10);
            return view('admin.role.role',compact('roles'));
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
        if(Auth::user()->can('create-role'))
        {
            return view('admin.role.create_role');
        }
        return view('error.404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request, RoleRepository $roleRepository)
    {
        $params = $request->all();
        $role = $roleRepository->createRole($params);
        $notification = array(
            'message'       =>  'Bạn đã tạo mới 1 role!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('role.index')->with($notification);
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
    public function edit($id, RoleRepository $roleRepository)
    {
        if(Auth::user()->can('edit-role'))
        {
            $role = $roleRepository->find($id);
            return view('admin.role.edit_role',compact('role'));
        }
        return view('error.404');
    }

    public function checkIssetName($name){
        $role = RoleModel::where('name','=',$name)->get();
        // dd($role);
        return count($role);
    }

    public function update(RoleRequest $request, $id, RoleRepository $roleRepository)
    {   
        $params = $request->all();
        // $checkName = $this->checkIssetName($params['name']);
        // dd($checkName);
        $role = $roleRepository->updateRole($params,$id);
        $notification = array(
            'message'       =>  'Bạn đã cập nhật 1 role!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('role.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, RoleRepository $roleRepository)
    {
        $role = $roleRepository->delete($id);
        return response()->json([
            'msg'   =>  'Role deleted',
            'status'=>  'Success!',
        ]);
    }

    public function showPermission($id, RoleRepository $roleRepository, PermissionRepository $permissionRepository){
        if(Auth::user()->can('show-list-role'))
        {
            $role = $roleRepository->find($id);
            $prs = DB::table('permission_role')->where('role_id',$role->id)->get();
            $permissions = $permissionRepository->getList(20);
            return view('admin.role.permission_role',compact(['permissions','prs','role']));
        }
        return view('error.404');
    }

    public function pickPermission(Request $request, $id, RoleModel $roleModel, PermissionRepository $permissionRepository){
        // dump($request['role_id']);
        // dd($id);
        $role = $roleModel->where('id',$request['role_id'])->first();
        $permission = $permissionRepository->find($id);
        $role->permissions()->attach($permission->id);
        $notification = array(
            'message'       =>  'Bạn đã active 1 permission!',
            'alert-type'    =>  'success',
        );
        return response()->json([
            'success' => true,
            'value' =>  $permission->id,
        ]);
    }

    public function unpickPermission(Request $request, $id, RoleModel $roleModel, PermissionRepository $permissionRepository){
        $role = $roleModel->where('id',$request['role_id'])->first();
        $permission = $permissionRepository->find($id);
        $role->permissions()->detach($permission->id);
        $notification = array(
            'message'       =>  'Bạn đã active 1 permission!',
            'alert-type'    =>  'success',
        );
        return response()->json([
            'success' => $permission->save(),
            'value' =>  $permission->id,
        ]);
    }
    public function backPage(){
        return redirect()->route('role.index');
    }

    public function searchPermission(Request $request, PermissionModel $permissionModel, RoleRepository $roleRepository,$id){
        $output = [];
        $checked="";
        $role = $roleRepository->find($id);
        $searchNamePermissions = $permissionModel->where('name','like','%'.$request->searchPermission.'%')->get();
        foreach ($searchNamePermissions as $searchNamePermission) {
            if(isset($searchNamePermission)){
               $output[] = '<tr>'.
                   '<td>'.$searchNamePermission->id.'</td>'.
                   '<td>'.$searchNamePermission->name.'</td>'.
                   '<td>'.$searchNamePermission->display_name.'</td>'.
                   '<td>'.$searchNamePermission->description.'</td>'.
                   '<td>'.'<div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;"><input type="checkbox" name="active" class="active-permission" data-permission-id="'.$searchNamePermission->id.'" '.$checked.'><div class="state p-success"><i class="icon fa fa-check"></i><label></label></div></div>'.'<input type="hidden" name="role_id" class="role_id" value="'.$role->id.'">'.'</td>'.
                   '</tr>'; 
            }
            
        }
        return response()->json($output);
    }
}
