<?php

use Illuminate\Support\Facades\Route;
use Hshafiei374\Bitrah\Http\Controllers\BitrahController;

if (config('bitrah.define_default_callback_url')) {
    Route::post('/call_back', [BitrahController::class, 'callBack'])->name('bitrah.callback');
}
