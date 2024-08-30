<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\State'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'states', 'as' => 'states.'], function () {

        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'states-ajax', 'as' => 'states.ajax.'], function () {
            Route::post('/update', [
                'as' => 'update',
                'uses' => 'StateAjaxController@update'
            ]);
        });
    });
});
