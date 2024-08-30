<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\Setting'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'SettingController@index'
            ]);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'settings-ajax', 'as' => 'settings.ajax.'], function () {
            Route::post('/update', [
                'as' => 'update',
                'uses' => 'SettingAjaxController@update'
            ]);
        });
    });
});
