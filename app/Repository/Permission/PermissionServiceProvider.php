<?php namespace App\Repository\Permission;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider {

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
            'App\Repository\Permission\PermissionInterface',
            'App\Repository\Permission\PermissionReposititory'
        );
    }

}
