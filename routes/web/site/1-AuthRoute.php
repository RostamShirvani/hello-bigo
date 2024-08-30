<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Auth'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['as' => 'auth.'], function () {
        });
        Route::group(['middleware' => ['is.ajax'], 'as' => 'auth.ajax.'], function () {
            Route::post('/auth/check', [
                'as' => 'check',
                'uses' => 'AuthAjaxController@check'
            ])->middleware('throttle:5,1');
            Route::post('/auth/login', [
                'as' => 'login',
                'uses' => 'AuthAjaxController@login'
            ]);
            Route::post('/auth/register', [
                'as' => 'register',
                'uses' => 'AuthAjaxController@register'
            ]);
            Route::post('/auth/sync', [
                'as' => 'sync',
                'uses' => 'AuthAjaxController@sync'
            ]);
            Route::post('/auth/logout', [
                'as' => 'logout',
                'uses' => 'AuthAjaxController@logout'
            ]);
        });
    });
});
