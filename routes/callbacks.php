<?php

use Illuminate\Support\Facades\Route;
use Hshafiei374\Bitrah\Http\Controllers\BitrahController;

if (config('bitrah.define_default_callback_url')) {
    Route::any(config('bitrah.default_callback_url_route'), 'Hshafiei374\Bitrah\Http\Controllers\BitrahController@callBack')->name('bitrah.callback');
}

