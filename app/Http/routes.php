<?php

/**
 * --------------------------------------------------------------------------
 * Auth
 * --------------------------------------------------------------------------
 */
Route::group(['prefix' => 'auth'], function () {

    Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\SessionsController@create']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\SessionsController@store']);
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionsController@destroy']);

    Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AccountsController@create']);
    Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AccountsController@store']);

});

/**
 * --------------------------------------------------------------------------
 * OAuth
 * --------------------------------------------------------------------------
 */
Route::group(['prefix' => 'oauth/{provider}'], function () {

    Route::get('login', [
        'as'   => 'oauth.login',
        'uses' => 'Auth\OAuthController@login',
    ]);

    Route::get('redirect', [
        'as'   => 'oauth.redirect',
        'uses' => 'Auth\OAuthController@redirectToProvider',
    ]);

    Route::get('callback', [
        'as'   => 'oauth.callback',
        'uses' => 'Auth\OAuthController@handleProviderCallback',
    ]);

});

// Api routes
//Route::group(['prefix' => 'api'], function () {
//    // ## Users
//    Route::resource('users', 'Api\UsersController', ['except' => ['create', 'edit']]);
//
//    // ## Settings
//    Route::get('settings', 'Api\SettingsController@index');
//    Route::put('settings', 'Api\SettingsController@update');
//
//    // ## Slugs
//    Route::get('slugs/{type}/{name}', 'Api\SlugsController@generate');
//});

// ## Files
Route::post('files/{name?}', [
    'as'   => 'upload',
    'uses' => 'FilesController@store'
]);

//Route::get('files/{id}/{name}', [
//    'as'   => 'file',
//    'uses' => 'FilesController@serve'
//])->where(['id' => '^[a-z0-9-]+$', 'name' => '.+']);

// Frontend routes
Route::get('/', ['as' => 'home', 'uses' => 'FrontendController@home']);