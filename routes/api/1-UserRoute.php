<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => [
    'api',
//    'middleware' => 'throttle:3,60'
], 'namespace' => 'App\Http\Controllers\API\User'], function () {
    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::post('/getUserDetail', [
                'as' => 'getUserDetail',
                'uses' => 'UserController@getUserDetail'
            ]);
        });
    });
});
