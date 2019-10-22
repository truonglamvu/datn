<?php namespace App\Repository\Post;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return  void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return  void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\Post\PostInterface',
            'App\Repository\Post\PostReposititory'
        );
    }

}
