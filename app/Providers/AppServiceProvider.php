<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        /* $router = app()->make('router');

        $paths = ['services/testee', 'services/teste5'];

        foreach($paths as $path){
            $router->get($path, 'App\Http\Controllers\HomeController@index');
        } */
    }
}
