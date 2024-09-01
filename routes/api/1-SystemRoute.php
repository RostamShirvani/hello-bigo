<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api'], 'namespace' => 'App\Http\Controllers\API\System'], function () {
    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        Route::group(['prefix' => 'system', 'as' => 'system.'], function () {
            Route::post('/health', [
                'as' => 'health',
                'uses' => 'SystemController@health'
            ]);
        });
    });
});
