<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Repository\Menus\MenusRepository;
use App\Repository\Role\RoleRepository;
use App\Repository\Menus\MenusModel;
use Auth;
class MenuController extends Controller
{

    public function index(MenusRepository $MenusRepository)
    {
        if(Auth::user()->can('view-menu'))
        {
            $menus = $MenusRepository->menuListing();
            return view('admin.menu.menu',compact('menus'));
        }
        
        return view('error.404');
    }

    public function create(MenusRepository $menuRepository)
    {
        if(Auth::user()->can('create-menu')){
            $menus = $menuRepository->getMenu();
            return view('admin.menu.create_menu',compact('menus')); 
        }
        return view('error.404');
    }

    public function store(MenuRequest $request, MenusRepository $menuRepository)
    {
        $params = $request->all();
        $menu = $menuRepository->createMenu($params);
        $notification = array(
            'message'       =>  'Bạn đã tạo mới 1 menu!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('menu.index')->with($notification);
    }

    public function show($id)
    {
        
    }

    public function edit($id, MenusRepository $menuRepository)
    {
        if(Auth::user()->can('edit-menu'))
        {
            $menus = $menuRepository->getAll();
            $menu = $menuRepository->find($id);
            return view('admin.menu.edit_menu',compact(['menu','menus']));
        }
        
        return view('error.404');
    }

    public function update(MenuRequest $request, $id, MenusRepository $menuRepository)
    {
        $params = $request->all();
        $menu = $menuRepository->updateMenu($params,$id);
        $notification = array(
            'message'       =>  'Bạn đã cập nhật 1 menu!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('menu.index')->with($notification);
    }

    public function destroy($id, MenusRepository $menuRepository)
    {
        $menu = $menuRepository->delete($id);
        return response()->json([
            'msg'   =>  'Menu deleted',
            'status'=>  'Success!',
        ]);
    }

    public function loadRole($id, MenusRepository $menuRepository, RoleRepository $roleRepository, MenusModel $menuModel){
        if(Auth::user()->can('show-list-role'))
        {
            $menu = $menuRepository->find($id);
            $mrs = $menuModel->where('id',$id)->get();
            $roles = $roleRepository->getList(6);
            return view('admin.menu.load-role_menu',compact(['menu','roles','mrs']));
        }
        
        return view('error.404');
    }

    public function pickRole(Request $request,$id, MenusModel $menuModel, RoleRepository $roleRepository)
    {
        $menu = $menuModel->where('id',$request['menu_id'])->first();
        $role = $roleRepository->find($id);
        $arr = $menu->visible_on;
        array_push($arr, $role->name);
        $menu->update([
            'visible_on' => serialize($arr)
        ]);
        return response()->json([
            'success' => true,
            'value' =>  $role->name,
        ]);
    }

    public function unPickRole(Request $request,$id, MenusModel $menuModel, RoleRepository $roleRepository)
    {
        $menu = $menuModel->where('id',$request['menu_id'])->first();
        $role = $roleRepository->find($id);
        $arr = $menu->visible_on;
        $arr_new = [];
        foreach ($arr as $role_name) {
            if($role_name != $role->name && $role_name !== false){
                $arr_new[] = $role_name;
            }
        }

        $menu->update([
            'visible_on' => serialize($arr_new)
        ]);
        return response()->json([
            'success' => true,
            'value' =>  $role->name,
        ]);
    }

    public function backPage(){
        return redirect()->route('menu.index');
    }
}
