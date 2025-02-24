<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Illuminate\Support\Facades\Log::info('test', ['message' => 'test']);
    return view('welcome');
});

Route::get('/api/test', function () {
    return response()->json([
        'message' => 'Hello World'
    ], 200);
});
