<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'v1', 'namespace'   =>  'App\Http\Controllers\Api\V1'], function () {
    Route::get('phone-numbers', 'ApiController@phoneNumbersList')->name('api.phone-numbers.list');
    Route::get('countries-list', 'ApiController@countriesList')->name('api.countries.list');
});