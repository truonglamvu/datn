<?php

namespace App\Http\Controllers\Auth;

// use App\User;
use App\Repository\Users\UsersModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'date_of_birth' =>  'required',
            'address'   =>  'required|string|max:255',
            'gender'    =>  'required',
            'phone'     =>  'required|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'login_name'=>  'required|string|max:255',
            'avarta'    =>  'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, UsersModel $userModel)
    {
        return User::create([
            'name' => $data['name'],
            'date_of_birth' =>  strtotime($data['date_of_birth']),
            'address'   =>  $data['address'],
            'gender'    =>  $data['gender'],
            'phone'     =>  $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'login_name'    =>  $data['login_name'],
            'avarta'        =>  $data['avarta'],
            'status'        =>  $data['status'],
        ]);
    }
}
