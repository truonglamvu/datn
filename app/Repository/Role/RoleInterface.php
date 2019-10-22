<?php namespace App\Repository\Role;
interface RoleInterface {
	public function createRole(Array $params);

	public function updateRole(Array $params, $id);
}
