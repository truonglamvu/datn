<?php namespace App\Repository\Permission;

use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade
{
    /**
     * Get the registered name of the repository.
     *
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repository\Permission\PermissionRepository';
    }
}
