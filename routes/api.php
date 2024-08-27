<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::namespace('API')->group(function(){

    Route::prefix('temperatura')->group(function(){
        Route::post('enviar', 'TemperaturaController@enviar');
    });
});


