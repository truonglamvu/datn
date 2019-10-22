<?php echo '<?php'; ?> namespace App\Repository\{{$repository}};

use Illuminate\Support\ServiceProvider;

class {{$repository}}ServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\{{$repository}}\{{$repository}}Interface',
            'App\Repository\{{$repository}}\{{$repository}}Reposititory'
        );
    }

}
