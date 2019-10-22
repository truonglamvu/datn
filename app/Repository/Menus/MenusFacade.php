<?php namespace App\Repository\Menus;

use Illuminate\Support\Facades\Facade;

class MenusFacade extends Facade
{
    /**
     * Get the registered name of the repository.
     *
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repository\Menus\MenusRepository';
    }
}
