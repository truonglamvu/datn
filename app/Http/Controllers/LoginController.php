<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repository\Users\UsersRepository;
use App\Repository\Role\RoleRepository;
use Auth;
class LoginController extends Controller
{
    public function getViewLogin(){
    	return view('guest.login');
    }

    public function login(Request $request){
    	if (Auth::attempt([
    		'email'	=>	$request->email,
    		'password'	=>	$request->password,
    	])) 
    	{
    		return redirect()->route('guest.index');
    	}
    	return redirect()->back();
    }
    public function logoutGuest(Request $request) {
        Auth::logout();
        return redirect('/guest-login');
    }

    public function getViewRegisterAdmin(){
        return view('auth.register');
    }

    public function getViewRegisterGuest(){
        return view('guest.register');
    }

    public function register(UserRequest $request, UsersRepository $userRepository, RoleRepository $roleRepository)
    {   
        $params = $request->all();
        $role = $roleRepository->find(1);
        if ($request->hasFile('avarta')) {
            $files =$request->file('avarta');
            $filesName = $files->getClientOriginalName();
            $file=$files->move('uploads/', $filesName);
            $params['avarta'] = $filesName;
            $user = $userRepository->createUser($params);
            $user->roles()->attach($role->id);
            $user->save();
        }
        return redirect('/');
    }
}
