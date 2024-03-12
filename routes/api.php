<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/{userId}/assign-role/{roleId}', [UserController::class, 'assignRole']);
})->middleware('auth:sanctum');

Route::prefix('folders')->group(function () {
    Route::get('/', [FolderController::class, 'index']);
    Route::post('/', [FolderController::class, 'store']);
    Route::post('/create/child', [FolderController::class, 'createChildFolder']);
})->middleware('auth:sanctum');
