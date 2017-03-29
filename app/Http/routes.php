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

        Route::group(['prefix' => '/requests'], function() {

            Route::get('/', [
                'as' => 'adminpendingrequests',
                'uses' => 'AdminController@pendingRequests'
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

            Route::post('/fill/{id}', [
                'as' => 'fillrequest',
                'uses' => 'AdminController@fill'
            ]);

            Route::post('/decline/{id}', [
                'as' => 'declinerequest',
                'uses' => 'AdminController@decline'
            ]);

            Route::get('/cancelled', [
                'as' => 'admincancelledrequests',
                'uses' => 'AdminController@cancelledRequests'
            ]);

        });

        Route::group(['prefix' => '/users'], function() {

            Route::get('/', [
                'as' => 'adminusers',
                'uses' => 'AdminController@users'
            ]);

            Route::post('/edit', [
                'as' => 'edituser',
                'uses' => 'UsersController@edituser'
            ]);

            Route::get('/delete/{id}', [
                'as' => 'destroyuser',
                'uses' => 'UsersController@destroy'
            ]);

            Route::get('/{id}', [
                'as' => 'showuser',
                'uses' => 'UsersController@showuser'
            ]);

        });

        Route::group(['prefix' => '/errors'], function() {

            Route::get('/', [
                'as' => 'adminerrors',
                'uses' => 'AdminController@errors'
            ]);

            Route::get('/resolve/{id}', [
                'as' => 'resolveerror',
                'uses' => 'ErrorController@resolve'
            ]);

        });

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

    Route::get('/cancel/{id}', [
        'as' => 'cancelrequest',
        'uses' => 'RequestController@cancel'
    ]);

    // Errors

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

 // Authentication Routes...
 $this->get('login', 'AuthController@showLoginForm');
 $this->post('login', 'AuthController@login');
 $this->get('logout', 'AuthController@logout');

 // Registration Routes...
 $this->get('register', 'AuthController@showRegistrationForm');
 $this->post('register', 'AuthController@register');

 // Password Reset Routes...
 $this->get('password/reset/{token?}', 'PasswordController@showResetForm');
 $this->post('password/email', 'PasswordController@sendResetLinkEmail');
 $this->post('password/reset', 'PasswordController@reset');

 Route::group(['prefix' => '/api'], function() {

        Route::get('/search/{type}/{query}', [
            'as' => 'apisearch',
            'uses' => 'ApiController@search'
        ]);

        Route::post('/requests/submit', [
            'as' => 'apirequestsubmit',
            'uses' => 'ApiController@requestSubmit'
        ]);

        Route::get('/login/{email}/{password}', [
            'as' => 'apilogin',
            'uses' => 'ApiController@login'
        ]);

    });

Route::group(['middleware' => 'registration'], function() {

    Route::post('register', 'AuthController@postRegister');

});