<?php

use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route::post('/login', [authController::class, 'login']);
// Route::post('/register', [authController::class, 'register']);




Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [authController::class, 'logout']);
    Route::get('/profile', [authController::class, 'profile']);
    Route::get('/check-auth', [authController::class, 'checkAuth']);
    Route::post('/store-file', [authController::class, 'storeFile']);
    Route::post('/store-file-public', [authController::class, 'storeFilePublic']);


});



Route::post('/store',[UsersController::class,'store']);

Route::post('/add-users',[UsersController::class,'processUsers']);



Route::get('/posts', [authController::class, 'posts']);
