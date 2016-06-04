<?php

/*
 * Admin routes
 */

Route::group(['middleware' => 'admin'], function() {

});

/*
 * User routes
 */

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'RequestController@home'
    ]);

});

/*
 * Public routes
 */

Route::get('register', [
    'as' => 'register',
    'uses' => 'AuthController@getRegister',
]);

Route::post('register', 'AuthController@postRegister');

Route::get('login', [
    'as' => 'login',
    'uses' => 'AuthController@getLogin',
]);

Route::post('login', 'AuthController@postLogin');

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'AuthController@getLogout',
]);
Route::auth();

Route::get('/home', 'HomeController@index');
