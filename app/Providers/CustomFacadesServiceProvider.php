<?php

namespace App\Providers;

use App\Freezolar\Cliente\ClienteConfig;
use App\Freezolar\Site\SiteConfig;
use Illuminate\Support\ServiceProvider;

class CustomFacadesServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('siteconfig',function() {
            return new SiteConfig();
        });
        $this->app->bind('clienteconfig',function() {
            return new ClienteConfig();
        });
    }


    public function boot()
    {
        //
    }
}
