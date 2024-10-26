<?php

use App\Http\Controllers\Admin\PaymentPin\PaymentPinController;
use Illuminate\Support\Facades\Route;

Route::get('/testt', function (){
    return 'll';
});
Route::group(['middleware' => ['web', 'auth', 'role:super_admin|admin'], 'namespace' => 'App\Http\Controllers\Admin\PaymentPin'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'payment-pins', 'as' => 'payment-pins.'], function () {
            Route::match(['get', 'head'], '/', [
                'as' => 'index',
                'uses' => 'PaymentPinController@index'
            ]);
            Route::match(['get', 'head'], '/create', [
                'as' => 'create',
                'uses' => 'PaymentPinController@create'
            ]);
            Route::match(['get', 'head'], '/using', [
                'as' => 'using',
                'uses' => 'PaymentPinController@using'
            ]);
            Route::post('/', [
                'as' => 'store',
                'uses' => 'PaymentPinController@store'
            ]);
            Route::post('/using', [
                'as' => 'storeUsing',
                'uses' => 'PaymentPinController@storeUsing'
            ]);
            Route::post('/toggle-state/{id}', [PaymentPinController::class, 'toggleState']);
        });
        Route::group(['middleware' => ['is.ajax'], 'prefix' => 'payment-pins-ajax', 'as' => 'payment-pins.ajax.'], function () {
            Route::post('/status', [
                'as' => 'status',
                'uses' => 'PaymentPinAjaxController@status'
            ]);
        });
    });
});
