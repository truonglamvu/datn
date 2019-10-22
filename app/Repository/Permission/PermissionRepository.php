<?php namespace App\Repository\Permission;

use App\Repository\Repository;
use App\Repository\Permission\PermissionModel;
class PermissionRepository extends Repository implements PermissionInterface
{
	/**
     * get model
     * @return  string
     */
    public function model()
    {
        return "App\Repository\Permission\PermissionModel";
    }

    public function createPermission(Array $params)
    {
    	$permission = $this->_model->create([
    		'name'	=>	$params['name'],
    		'display_name'	=>	$params['display_name'],
    		'description'	=>	$params['description'],
    	]);

    	return $permission;
    }

    public function updatePermission(Array $params, $id)
    {
    	$permission = $this->_model->find($id)->update([
    		'name'	=>	$params['name'],
    		'display_name'	=>	$params['display_name'],
    		'description'	=>	$params['description'],
    	]);

    	return $permission;
    }
}