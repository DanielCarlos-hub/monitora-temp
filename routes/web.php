<?php

use Illuminate\Support\Facades\Route;

Route::pattern('tenant', '^((?!www).)*$');

Route::namespace('Auth')->name('auth.')->group(function(){
    Route::get('/', 'AdminLoginController@index')->name('login');
    Route::post('login', 'AdminLoginController@login')->name('login.submit');
    Route::get('logout', 'AdminLoginController@logout')->name('logout');
});

Route::namespace('Dashboard')->middleware('checkAdminUser')->name('dashboard.')->group(function(){

    Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function(){
        Route::get('home', 'HomeController@home')->name('home');
        Route::resource('usuarios', 'UsersController');

        Route::resource('clientes', 'TenantController');
        Route::resource('clientes.equipamentos', 'ClienteEquipamentosController', ['except' => ['destroy']]);
        Route::get('clientes/{cliente}/equipamento/{equipamento}/notificacoes', 'ClienteEquipamentosController@notifications')->name('clientes.equipamentos.notificacoes');
        Route::get('clientes/{cliente}/equipamento/{equipamento}/logs', 'ClienteEquipamentosController@logs')->name('clientes.equipamentos.logs');
        Route::get('clientes/{cliente}/equipamento/{equipamento}/logs/{log}', 'ClienteEquipamentosController@visualizarLog')->name('clientes.equipamentos.logs.show');
        Route::get('cliente/{cliente}/equipamento/{equipamento}/json', 'ClienteEquipamentosController@getEquipamentoJson')->name('equipamento.json');
        Route::get('cliente/{cliente}/equipamento/{equipamento}/temperatura', 'ClienteEquipamentosController@getEquipamentoTemp')->name('equipamento.temperatura');

        Route::delete('cliente/{cliente}/equipamento/{equipamento}/clear', 'ClienteEquipamentosController@clearTemperaturas')->name('clientes.equipamentos.clear');
    });

    Route::namespace('Monitoramento')->name('monitoramento.')->prefix('monitoramento')->group(function(){
        Route::get('home', 'HomeController@home')->name('home');

        Route::resource('clientes', 'TenantController');
        Route::resource('clientes.equipamentos', 'ClienteEquipamentosController', ['except' => ['destroy']]);
        Route::get('clientes/{cliente}/equipamento/{equipamento}/notificacoes', 'ClienteEquipamentosController@notifications')->name('clientes.equipamentos.notificacoes');
        Route::get('clientes/{cliente}/equipamento/{equipamento}/logs', 'ClienteEquipamentosController@logs')->name('clientes.equipamentos.logs');
        Route::get('clientes/{cliente}/equipamento/{equipamento}/logs/{log}', 'ClienteEquipamentosController@visualizarLog')->name('clientes.equipamentos.logs.show');
        Route::get('cliente/{cliente}/equipamento/{equipamento}/json', 'ClienteEquipamentosController@getEquipamentoJson')->name('equipamento.json');
        Route::get('cliente/{cliente}/equipamento/{equipamento}/temperatura', 'ClienteEquipamentosController@getEquipamentoTemp')->name('equipamento.temperatura');

        Route::delete('cliente/{cliente}/equipamento/{equipamento}/clear', 'ClienteEquipamentosController@clearTemperaturas')->name('clientes.equipamentos.clear');
    });

});

Route::group(['domain' => '{tenant}.' . config('app.domain'), 'middleware' => 'tenant'], function () {

    Route::get('/', 'RedirectController@redirect');
    Route::namespace('Auth')->name('auth.')->group(function(){
        Route::get('cliente/login', 'LoginController@showLoginForm')->name('cliente.login');
        Route::post('cliente/login', 'LoginController@login')->name('cliente.login.submit');
        Route::get('cliente/logout', 'LoginController@logout')->name('cliente.logout');
    });

    Route::namespace('Dashboard')->middleware('checkUser')->group(function(){
        Route::namespace('Cliente')->name('cliente.')->prefix('cliente')->group(function(){
            Route::get('home', 'HomeController@home')->name('home');
            Route::get('configuracoes', 'ClienteConfigController@clienteConfig')->name('config');
            Route::post('configuracoes/{config}', 'ClienteConfigController@updateClienteConfig')->name('config.submit');

            Route::get('equipamento/{equip}/temperatura', 'HomeController@getEquipamentoTemp')->name('equipamento.temperatura');
            Route::get('equipamento/{equipamento}', 'HomeController@showEquipamento')->name('equipamento.show');
        });
    });

});


