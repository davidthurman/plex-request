 <?php

/*
 * Admin routes
 */

Route::group(['middleware' => 'admin'], function() {

    Route::group(['prefix' => '/admin'], function() {

        Route::get('/', [
            'as' => 'admindashboard',
            'uses' => 'AdminController@dashboard'
        ]);

        Route::get('/requests/pending', [
            'as' => 'adminpendingrequests',
            'uses' => 'AdminController@pendingRequests'
        ]);

        Route::get('/users', [
            'as' => 'adminusers',
            'uses' => 'AdminController@users'
        ]);

        Route::get('/errors', [
            'as' => 'adminerrors',
            'uses' => 'AdminController@errors'
        ]);

        Route::group(['prefix' => '/requests'], function() {

            Route::get('/', [
                'as' => 'admindisplayrequests',
                'uses' => 'AdminController@displayRequests'
            ]);

            Route::get('/pending', [
                'as' => 'adminpendingrequests',
                'uses' => 'AdminController@pendingRequests'
            ]);

            Route::get('/filled', [
                'as' => 'adminfilledrequests',
                'uses' => 'AdminController@filledRequests'
            ]);

            Route::get('/declined', [
                'as' => 'admindeclinedrequests',
                'uses' => 'AdminController@declinedRequests'
            ]);

            Route::get('/fill/{id}', [
                'as' => 'fillrequest',
                'uses' => 'AdminController@fill'
            ]);

            Route::get('/decline/{id}', [
                'as' => 'declinerequest',
                'uses' => 'AdminController@decline'
            ]);

        });

        Route::get('/showuser/{id}', [
            'as' => 'showuser',
            'uses' => 'UsersController@showuser'
        ]);

        Route::post('/edituser', [
            'as' => 'edituser',
            'uses' => 'UsersController@edituser'
        ]);

        Route::get('/deleteuser/{id}', [
            'as' => 'destroyuser',
            'uses' => 'UsersController@destroy'
        ]);



        Route::get('/resolveerror/{id}', [
            'as' => 'resolveerror',
            'uses' => 'ErrorController@resolve'
        ]);

    });

});

/*
 * User routes
 */

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', [
       'as' => 'home',
       'uses' => 'RequestController@searchpage'
    ]);

    Route::get('/search', [
        'as' => 'search',
        'uses' => 'RequestController@searchPage'
    ]);

    Route::post('/searchrequest', [
        'as' => 'searchrequest',
        'uses' => 'RequestController@searchRequest'
    ]);

    Route::get('/requests', [
       'as' => 'displayrequests',
        'uses' => 'RequestController@displayRequests'
    ]);

    Route::get('/pendingrequests', [
        'as' => 'pendingrequests',
        'uses' => 'RequestController@pendingRequests'
    ]);

    Route::get('/filledrequests', [
        'as' => 'filledrequests',
        'uses' => 'RequestController@filledRequests'
    ]);

    Route::get('/declinedrequests', [
        'as' => 'declinedrequests',
        'uses' => 'RequestController@declinedRequests'
    ]);

    Route::get('/submitrequest/{tmdbid}/{type}', [
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