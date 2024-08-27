<?php

namespace App\Freezolar\Cliente\Facades;

use Illuminate\Support\Facades\Facade;

class ClienteConfigFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'clienteconfig';
    }
}
