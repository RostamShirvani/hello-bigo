<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\RazerAccount'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'razer_accounts', 'as' => 'razer_accounts.'], function () {
            Route::get('/', [
                'as' => 'index',
                'uses' => 'RazerAccountController@index'
            ]);

            Route::match(['get', 'head'], '/add', [
                'as' => 'add',
                'uses' => 'RazerAccountController@add'
            ]);

            Route::post('/', [
                'as' => 'store',
                'uses' => 'RazerAccountController@store'
            ]);
            Route::delete('/delete/{id}', [
                'as' => 'delete',
                'uses' => 'RazerAccountController@destroy'
            ]);
            Route::get('/edit/{id}', [
                'as' => 'edit',
                'uses' => 'RazerAccountController@edit'
            ]);
            Route::post('/update/{id}', [
                'as' => 'update',
                'uses' => 'RazerAccountController@update'
            ]);

        });

    });
});
