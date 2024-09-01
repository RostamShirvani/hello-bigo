<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api'], 'namespace' => 'App\Http\Controllers\API\PaymentPin'], function () {
    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        Route::group(['prefix' => 'payment-pins', 'as' => 'payment-pins.'], function () {
            Route::post('/using', [
                'as' => 'using',
                'uses' => 'PaymentPinController@using'
            ]);
        });
    });
});
