<?php namespace App\Repository\Permission;
interface PermissionInterface {

	public function createPermission(Array $params);

	public function updatePermission(Array $params, $id);
}
