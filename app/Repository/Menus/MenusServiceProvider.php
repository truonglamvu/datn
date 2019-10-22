<?php namespace App\Repository\Menus;

use Illuminate\Support\ServiceProvider;

class MenusServiceProvider extends ServiceProvider {

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
            'App\Repository\Menus\MenusInterface',
            'App\Repository\Menus\MenusReposititory'
        );
    }

}
