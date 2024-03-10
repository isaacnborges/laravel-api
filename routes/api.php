<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StudentController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'getById']);
Route::post('students', [StudentController::class, 'create'])->middleware('auth:sanctum');
Route::put('students/{id}', [StudentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('students/{id}', [StudentController::class, 'delete'])->middleware('auth:sanctum');