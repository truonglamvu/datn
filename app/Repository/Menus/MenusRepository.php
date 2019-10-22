<?php namespace App\Repository\Menus;

use App\Repository\Repository;
use App\Repository\Menus\MenusModel;
class MenusRepository extends Repository implements MenusInterface
{
	/**
     * get model
     * @return  string
     */
    public function model()
    {
        return "App\Repository\Menus\MenusModel";
    }

    public function createMenu(Array $params){
    	$menu = $this->_model->create([
    		'menu_name'			=>	$params['menu_name'],
    		'parent_id'	=>	(isset($params['id_menu_parent'])) ? $params['id_menu_parent'] : 0,
    	]);

    	return $menu;
    }

    public function updateMenu(Array $params, $id){
    	$menu = $this->_model->find($id)->update([
    		'menu_name'			=>	$params['menu_name'],
    		'parent_id'	=>	(isset($params['id_menu_parent'])) ? $params['id_menu_parent'] : 0,
    	]);

    	return $menu;
    }

    /**
     *
     * Get menu
     *
     */

    public function getMenu()
    {
        $parentMenu = $this->_model->parent()->get();
        
        $menu = $this->recursiveMenu($parentMenu);
        return $menu;
    }

    public function getAllMenu()
    {
        return $this->_model->with('posts')->get();
    }


    /**
     *
     * Get menu
     *
     */

    public function menuListing()
    {
        return $this->_model->orderBy('id','desc')->paginate(20);
    }

    private function recursiveMenu($menu,$level = 0)
    {
        $menus = new \stdClass;
        foreach ($menu as $key => $value) {
            $value->level = $level;
            $child = $this->_model->where('parent_id',$value->id)->get();
            if(!$child->isEmpty()) {
                $level_ = $level + 1;
                $this->recursiveMenu($child,$level_);
            }
            $value->child = $child;
            $menus->$key = $value;
        }

        return $menu;
    }
    
}