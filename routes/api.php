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

Route::group(['prefix' => 'incidente'], function ($router) {

    Route::get('safra/{safra}', 'IncidenteController@index');
    Route::post('store', 'IncidenteController@store');
    Route::get('{incidente}', 'IncidenteController@show');
    Route::put('{incidente}', 'IncidenteController@update');
    Route::delete('{incidente}', 'IncidenteController@destroy');

});


Route::group(['prefix' => 'lavoura'], function ($router) {

    Route::get('user/{user}', 'LavouraController@index');
    Route::post('store', 'LavouraController@store');
    Route::get('{lavoura}', 'LavouraController@show');
    Route::put('{lavoura}', 'LavouraController@update');
    Route::delete('{lavoura}', 'LavouraController@destroy');

});

Route::group(['prefix' => 'unidade'], function ($router) {

    Route::get('', 'UnidadeController@index');
    Route::get('{unidade}', 'UnidadeController@show');

});
