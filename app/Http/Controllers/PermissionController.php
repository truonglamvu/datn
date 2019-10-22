<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Repository\Permission\PermissionRepository;
use App\Repository\Permission\PermissionModel;
use Auth;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionModel $permissionModel)
    {
        if(Auth::user()->can('view-permission'))
        {
           $permissions = $permissionModel->orderBy('created_at','desc')->paginate(10);
            return view('admin.permission.permission',compact('permissions')); 
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
        if(Auth::user()->can('create-permission'))
        {
           return view('admin.permission.create_permission');
        }
        
        return view('error.404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request, PermissionRepository $permissionRepository)
    {
        $params = $request->all();
        $permission = $permissionRepository->createPermission($params);
        $notification = array(
            'message'       =>  'Bạn đã tạo mới 1 permission!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('permission.index')->with($notification);
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
    public function edit($id, PermissionRepository $permissionRepository)
    {
        if(Auth::user()->can('edit-permission'))
        {
            $permission = $permissionRepository->find($id);
            return view('admin.permission.edit_permission',compact('permission')); 
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
    public function update(PermissionRequest $request, $id, PermissionRepository $permissionRepository)
    {
        $params = $request->all();
        $permission = $permissionRepository->updatePermission($params,$id);
        $notification = array(
            'message'       =>  'Bạn đã cập nhật 1 permission!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('permission.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PermissionRepository $permissionRepository)
    {
        $permission = $permissionRepository->delete($id);
        return response()->json([
            'msg'   =>  'Permission deleted',
            'status'=>  'Success!',
        ]);
    }
    public function backPage(){
        return redirect()->route('permission.index');
    }
}
