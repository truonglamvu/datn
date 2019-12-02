<?php namespace App\Repository\Users;

use App\Repository\Repository;
use App\Repository\Users\UsersModel;
class UsersRepository extends Repository implements UsersInterface
{
	/**
     * get model
     * @return  string
     */
    public function model()
    {
        return "App\Repository\Users\UsersModel";
    }

    public function createUser(Array $params)
    {
        $user = $this->_model->create([
            'name'  => $params['name'],
            'date_of_birth' =>  date('Y-m-d', strtotime($params['date_of_birth'])),
            'address'   =>  $params['address'],
            'gender'    =>  $params['gender'],
            'phone'     =>  $params['phone'],
            'email'     =>  $params['email'],
            'password'  =>  bcrypt($params['password']),
            'login_name' => $params['login_name'],
            'status'    =>  $params['status'],  
            'avarta'    =>  $params['avarta'],  
        ]);
        return $user;
    }

    public function updateUser(Array $params, $id)
    {
    	$user = $this->_model->find($id)->update([
            'name'  => $params['name'],
            'date_of_birth' =>  $params['date_of_birth'],
            'address'   =>  $params['address'],
            'gender'    =>  $params['gender'],
            'phone'     =>  $params['phone'],
            'email'     =>  $params['email'],
            'login_name' => $params['login_name'],
            'status'    =>  $params['status'],  
            'avarta'    =>  $params['avarta'],  
        ]);
        return $user;
    }
}