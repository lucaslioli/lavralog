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

});
