<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//PUBLIC ROUTES

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//PROTECTED ROUTES

//Route::post('/logout', [AuthController::class,'logout'])->name('logout');
//Route::resource('/tasks',TaskController::class);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/tasks', TaskController::class);
});
