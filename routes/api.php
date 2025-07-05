<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeveloperController;

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



Route::prefix('devs')->group(function () {
    Route::post('/', [DeveloperController::class, 'store']);
    Route::get('/', [DeveloperController::class, 'index']);
    Route::get('/{id}', [DeveloperController::class, 'show']);
});