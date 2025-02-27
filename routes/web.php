<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome Stock Control Api',
        'deploy' => env('APP_ENV'),
        'now' => now()->toDateTimeString(),
    ]);
});
