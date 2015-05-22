<?php

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

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
Route::group(['prefix' => 'api'], function () {
    // ## Users
    Route::resource('users', 'Api\UsersController', ['except' => ['create', 'edit']]);

    // ## Settings
    Route::get('settings', 'Api\SettingsController@index');
    Route::get('settings/{key}', 'Api\SettingsController@show');
    Route::put('settings', 'Api\SettingsController@update');

    // ## Slugs
    Route::get('slugs/{type}/{name}', 'Api\SlugsController@generate');

    // ## Upload
    Route::post('uploads', ['as' => 'upload', 'uses' => 'Api\UploadController@store']);
});

// Admin routes
Route::get('administrator', 'AdminController@index');

// Frontend routes
Route::get('/', ['as' => 'frontend.home', 'uses' => 'FrontendController@home']);