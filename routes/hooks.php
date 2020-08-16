<?php

use Illuminate\Support\Facades\Route;
use Hshafiei374\Bitrah\Http\Controllers\BitrahController;

if (config('bitrah.define_default_webhook_url')) {
    Route::post('/web_hook', [BitrahController::class, 'webHook'])->name('bitrah.webhook');
}
