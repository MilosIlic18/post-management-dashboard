<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('auth')->controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');


    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
    });

});

Route::prefix('posts')
    ->controller(PostController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('', 'index');
        Route::post('','store');
        Route::put('/{id}', 'edit');
        Route::get('/status-counts','statusCounts');
        Route::get('/statistics', 'statistics');
    
});