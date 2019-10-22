<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Post\PostModel;
use App\Repository\Role\RoleModel;
use App\Repository\Permission\PermissionModel;
use App\Repository\Users\UsersModel;
use App\Repository\Menus\MenusRepository;
use Auth;
use View;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(PostModel $postModel, RoleModel $roleModel, PermissionModel $permissionModel, UsersModel $userModel, MenusRepository $menuRepository){
        $count_user = $userModel->count();
        $count_docs = $postModel->count();
        $count_role = $roleModel->count();
        $menuLists = $menuRepository->getAll();
        $count_permission = $permissionModel->count();
        View::share(['count_user' => $count_user, 'count_docs' => $count_docs, 'count_role' => $count_role, 'count_permission' => $count_permission, 'menuLists' => $menuLists]);
    }
    public function index(PostModel $postModel, MenusRepository $menuRepository)
    {
        if(Auth::user()->can('view-docs')){
            return view('admin.document.docs_api');
        }else{
            return "Bạn không có quyền truy cập! Mời quay lại trang chủ. <a style='text-decoration:none;' href = 'http://project.com/guest'>[quay lại]</a>";
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
