<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\Blacklist'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'blacklist', 'as' => 'blacklist.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'BlacklistController@index'
            ]);

            Route::match(['get', 'head'], '/add', [
                'as' => 'add',
                'uses' => 'BlacklistController@add'
            ]);

            Route::post('/', [
                'as' => 'store',
                'uses' => 'BlacklistController@store'
            ]);

        });

    });
});
