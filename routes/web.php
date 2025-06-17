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

Route::get('/test', function () {
    $users = User::whereNotNull('onesignal_player_id')->get();

    $playerIds = $users->pluck('onesignal_player_id')->toArray();

    if (!empty($playerIds)) {
        $response = app(OneSignalService::class)->sendPush(
            "Hi there",
            "This is a test notification",
            $playerIds
        );
        dd($response);
    }
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created';
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'Database migrated';
});
Route::get('/seed', function () {
    Artisan::call('db:seed');
    return 'Database seeded';
});
Route::get('/migrate-refresh-seed', function () {
    Artisan::call('migrate --seed');
    return 'Database migrated and seeded';
});
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimized and cleared';
});
