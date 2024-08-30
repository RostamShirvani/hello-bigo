<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Home'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['as' => 'homes.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'HomeController@index'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'as' => 'homes.ajax.'], function () {
        });
    });
});
