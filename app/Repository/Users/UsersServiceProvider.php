<?php namespace App\Repository\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

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
            'App\Repository\Users\UsersInterface',
            'App\Repository\Users\UsersReposititory'
        );
    }

}
