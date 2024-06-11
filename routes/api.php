<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//Solo para pruebas
Route::delete('/user/delete/{id}', [AuthController::class, 'delete']);
Route::post('/register', [AuthController::class, 'register']);