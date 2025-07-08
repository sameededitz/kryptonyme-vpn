<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('purchases:expire')
    ->daily()
    ->runInBackground()
    ->onSuccess(function () {
        Log::info('Expired purchases successfully.');
    })
    ->onFailure(function () {
        Log::error('Failed to expire purchases.');
    });
