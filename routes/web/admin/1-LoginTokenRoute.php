<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\LoginToken'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'login-tokens', 'as' => 'login-tokens.'], function () {
            Route::match(['get', 'head'], '/', [
                'as' => 'index',
                'uses' => 'LoginTokenController@index'
            ]);
            Route::match(['get', 'head'], '/create', [
                'as' => 'create',
                'uses' => 'LoginTokenController@create'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'login-tokens-ajax', 'as' => 'login-tokens.ajax.'], function () {
            Route::post('/', [
                'as' => 'store',
                'uses' => 'LoginTokenAjaxController@store'
            ]);
            Route::post('/sync', [
                'as' => 'sync',
                'uses' => 'LoginTokenAjaxController@sync'
            ]);
        });
    });
});
