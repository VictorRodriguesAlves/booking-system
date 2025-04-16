<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::prefix('reservation')->group( function () {
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/', [ReservationController::class, 'index']);
    Route::patch('/{reservation}/cancel', [ReservationController::class, 'cancel']);
    Route::put('/{reservation}', [ReservationController::class, 'update']);
});

