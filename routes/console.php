<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('purchases:expire')
    ->daily()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/expire_purchases.log'))
    ->onSuccess(function () {
        Log::info('Expired purchases successfully.');
    })
    ->onFailure(function () {
        Log::error('Failed to expire purchases.');
    });
