<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['api']], function () {
    Route::post('/api/register', [
        'uses' => 'Auth\AuthController@register',
    ]);

    Route::post('/api/signin', [
        'uses' => 'Auth\AuthController@signin',
    ]);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/api/user', [
            'uses' => 'UserController@index',
        ]);
    });

});
