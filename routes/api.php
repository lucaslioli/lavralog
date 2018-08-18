<?php

use Illuminate\Http\Request;

Route::get('docker-laravel-ip', function (Request $request) {
     return json_encode([
         'docker-ip' => $request->ip()
     ]);
});

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

});

Route::group(['prefix' => 'lavoura'], function ($router) {

    Route::get('user/{user}', 'LavouraController@index');
    Route::post('store', 'LavouraController@store');
    Route::get('{lavoura}', 'LavouraController@show');
    Route::put('{lavoura}', 'LavouraController@update');
    Route::delete('{lavoura}', 'LavouraController@destroy');

});

Route::group(['prefix' => 'safra'], function ($router) {

    Route::get('lavoura/{lavoura}', 'SafraController@index');
    Route::post('store', 'SafraController@store');
    Route::get('{safra}', 'SafraController@show');
    Route::put('{safra}', 'SafraController@update');
    Route::delete('{safra}', 'SafraController@destroy');

});

Route::group(['prefix' => 'unidade'], function ($router) {

    Route::get('', 'UnidadeController@index');
    Route::get('{unidade}', 'UnidadeController@show');

});

Route::group(['prefix' => 'insumo_tipo'], function ($router){

    Route::get('', 'InsumoTipoController@index');
    Route::get('{insumo_tipo}', 'InsumoTipoController@show');

});

Route::group(['prefix' => 'insumo'], function ($router){

    Route::get('', 'InsumoController@index');
    Route::post('store', 'InsumoController@store');

});