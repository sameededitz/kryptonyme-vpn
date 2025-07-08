<?php

use App\Models\User;
use App\Services\OneSignalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('login');
    }
})->name('home');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return response()->json([
        'output' => Artisan::output(),
        'status' => Artisan::output() ? 'success' : 'error',
    ]);
});

Route::get('artisan/{command}', function ($command) {
    if (Auth::check() && Auth::user()->isAdmin()) {
        Artisan::call($command);
        return response()->json(['output' => Artisan::output(), 'status' => Artisan::output() ? 'success' : 'error', 'command' => $command]);
    }
    return response()->json(['error' => 'Unauthorized'], 403);
})->where('command', '.*');

Route::get('/test', function () {
    dd(Auth::guard('admin')->user());
})->middleware('auth:admin');
