<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::middleware('jwt.verify')->post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('jwt.verify')->group(function () {
        Route::get('/package', [ShipmentController::class, 'index'])->name('shipment.all');
        Route::get('/package/{id}', [ShipmentController::class, 'show'])->name('shipment.show');
        Route::post('/package', [ShipmentController::class, 'store'])->name('shipment.store');
        Route::put('/package/{id}', [ShipmentController::class, 'update'])->name('shipment.replace');
        Route::patch('/package/{id}', [ShipmentController::class, 'update'])->name('shipment.update');
        Route::delete('/package/{id}', [ShipmentController::class, 'destroy'])->name('shipment.delete');
    });
});
