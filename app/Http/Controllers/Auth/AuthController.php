<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;

class AuthController extends Controller
{
    public function redirectToFacebook()
	{
	    return Socialite::driver('facebook')->redirect();
	}

	public function handleFacebookCallback()
	{
	    try {
	        $user = Socialite::driver('facebook')->user();
	        $create['name'] = $user->name;
	        $create['email'] = $user->email;

	        $userModel = new UserModel;
	        $createdUser = $userModel->addNew($create);
	        Auth::loginUsingId($createdUser->id);
	        return redirect()->route('guest');
	    } catch (Exception $e) {
	        return redirect('/');
	    }
	}
}
