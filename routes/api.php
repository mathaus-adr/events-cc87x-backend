<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventsSyncController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', CreateUserController::class);
Route::post('login', LoginUserController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('events', EventController::class);
    Route::post('events/sync', EventsSyncController::class);
    Route::resource('people', PersonController::class);
    Route::resource('bills', BillController::class);
});
