<?php namespace App\Repository\Post;

use Illuminate\Support\Facades\Facade;

class PostFacade extends Facade
{
    /**
     * Get the registered name of the repository.
     *
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repository\Post\PostRepository';
    }
}
