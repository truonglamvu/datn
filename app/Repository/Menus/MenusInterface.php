<?php namespace App\Repository\Menus;
interface MenusInterface {
	public function createMenu(Array $params);

	public function updateMenu(Array $params, $id);
}
