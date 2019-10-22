<?php namespace App\Repository\Role;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider {

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
            'App\Repository\Role\RoleInterface',
            'App\Repository\Role\RoleReposititory'
        );
    }

}
