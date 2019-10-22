<?php namespace App\Repository\Users;
interface UsersInterface {
	public function createUser(Array $params);

	public function updateUser(Array $params, $id);
}
