 <?php

/*
 * Admin routes
 */

Route::group(['middleware' => 'admin'], function() {

        Route::get('/admin', [
            'as' => 'admin',
            'uses' => 'RequestController@admin'
        ]);

        Route::post('/editadmin', [
            'as' => 'editadmin',
            'uses' => 'RequestController@editadmin'
        ]);

        Route::get('/deleterequest/{id}', [
            'as' => 'deleterequest',
            'uses' => 'RequestController@destroy'
        ]);

        Route::get('/deleteerror/{id}', [
            'as' => 'deleteerror',
            'uses' => 'ErrorController@destroy'
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

    Route::get('/submitrequest/{imdbID}', [
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
     'uses' => 'Auth\AuthController@getRegister',
 ]);



Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin',
]);

Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\AuthController@getLogout',
]);

Route::auth();


Route::group(['middleware' => 'registration'], function() {

    Route::post('register', 'Auth\AuthController@postRegister');

});