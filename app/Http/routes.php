 <?php

/*
 * Admin routes
 */

Route::group(['middleware' => 'admin'], function() {

        Route::get('/admin', [
            'as' => 'admin',
            'uses' => 'RequestController@admin'
        ]);

        Route::post('/deleterequest', [
            'as' => 'deleterequest',
            'uses' => 'RequestController@destroy'
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

    Route::post('/searchrequest', [
        'as' => 'searchrequest',
        'uses' => 'RequestController@searchRequest'
    ]);

    Route::post('/submitrequest', [
        'as' => 'submitrequest',
        'uses' => 'RequestController@submit'
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
