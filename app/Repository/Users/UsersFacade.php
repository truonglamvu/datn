<?php namespace App\Repository\Users;

use Illuminate\Support\Facades\Facade;

class UsersFacade extends Facade
{
    /**
     * Get the registered name of the repository.
     *
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repository\Users\UsersRepository';
    }
}
