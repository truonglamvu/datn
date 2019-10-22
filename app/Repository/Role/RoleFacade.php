<?php namespace App\Repository\Role;

use Illuminate\Support\Facades\Facade;

class RoleFacade extends Facade
{
    /**
     * Get the registered name of the repository.
     *
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repository\Role\RoleRepository';
    }
}
