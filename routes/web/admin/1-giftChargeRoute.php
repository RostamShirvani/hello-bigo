<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\GiftCharge'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'gift_charge', 'as' => 'gift_charge.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'GiftChargeController@index'
            ]);

            Route::match(['get', 'head'], '/add', [
                'as' => 'add',
                'uses' => 'GiftChargeController@add'
            ]);

            Route::post('/', [
                'as' => 'store',
                'uses' => 'GiftChargeController@store'
            ]);
            Route::delete('/delete/{id}', [
                'as' => 'delete',
                'uses' => 'GiftChargeController@destroy'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'edit',
                'uses' => 'GiftChargeController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'update',
                'uses' => 'GiftChargeController@update'
            ]);

        });

    });
});
