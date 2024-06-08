<?php

use Illuminate\Support\Facades\Route;

//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);
Route::apiResource('/admins', App\Http\Controllers\Api\AdminController::class);
Route::apiResource('/activity', App\Http\Controllers\Api\ActivityController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');