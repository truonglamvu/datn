<?php namespace App\Repository\Role;

use App\Repository\Repository;
use App\Repository\Role\RoleModel;

class RoleRepository extends Repository implements RoleInterface
{
	/**
     * get model
     * @return  string
     */
    public function model()
    {
        return "App\Repository\Role\RoleModel";
    }

    public function createRole(Array $params)
    {
    	$role = $this->_model->create([
    		'name'	=>	$params['name'],
    		'display_name'	=>	$params['display_name'],
    		'description'	=>	$params['description'],
    	]);

    	return $role;
    }

    public function updateRole(Array $params, $id)
    {
    	$role = $this->_model->find($id)->update([
    		'name'	=>	$params['name'],
    		'display_name'	=>	$params['display_name'],
    		'description'	=>	$params['description'],
    	]);

    	return $role;
    }
}