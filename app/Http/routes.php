<?php

/*
 * Admin routes
 */

Route::group(['middleware' => 'admin'], function() {

        Route::get('/admin', [
            'as' => 'admin',
            'uses' => 'RequestController@admin'
        ]);

});

/*
 * User routes
 */

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'RequestController@allRequests'
    ]);

    Route::get('/userrequests', [
        'as' => 'userrequests',
        'uses' => 'RequestController@userRequests'
    ]);

    Route::get('/reporterror', [
        'as' => 'reporterror',
        'uses' => 'ErrorController@reportError'
    ]);

    Route::post('/submiterror', [
        'as' => 'submiterror',
        'uses' => 'ErrorController@submitError'
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
