<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'App\Http\Controllers\Site\Page'], function () {
    Route::group(['as' => 'site.'], function () {
        Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
            Route::get('/{slug}', [
                'as' => 'show',
                'uses' => 'PageController@show'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'as' => 'pages.ajax.'], function () {
        });
    });
});
