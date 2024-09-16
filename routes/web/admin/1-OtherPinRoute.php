<?php

use App\Http\Controllers\Admin\OtherPin\OtherPinController;
use Illuminate\Support\Facades\Route;

Route::get('/testt', function (){
    return 'll';
});
Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\OtherPin'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'other-pins', 'as' => 'other-pins.'], function () {
            Route::match(['get', 'head'], '/', [
                'as' => 'index',
                'uses' => 'OtherPinController@index'
            ]);
            Route::match(['get', 'head'], '/create', [
                'as' => 'create',
                'uses' => 'OtherPinController@create'
            ]);
            Route::match(['get', 'head'], '/using', [
                'as' => 'using',
                'uses' => 'OtherPinController@using'
            ]);
            Route::post('/', [
                'as' => 'store',
                'uses' => 'OtherPinController@store'
            ]);
            Route::post('update/{id}', [
                'as' => 'update',
                'uses' => 'OtherPinController@update'
            ]);
            Route::post('/using', [
                'as' => 'storeUsing',
                'uses' => 'OtherPinController@storeUsing'
            ]);
            Route::post('/toggle-state/{id}', [OtherPinController::class, 'toggleState']);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'other-pins-ajax', 'as' => 'other-pins.ajax.'], function () {
            Route::post('/status', [
                'as' => 'status',
                'uses' => 'OtherPinAjaxController@status'
            ]);
        });
    });
});
