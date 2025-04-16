<?php

use App\Http\Controllers\ReservationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function (Request $request) {
    return response()->json([
        'pong' => true,
        'users' => User::all()

    ]);
});

Route::prefix('reservation')->group( function () {
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/', [ReservationController::class, 'index']);
    Route::patch('/{reservation}/cancel', [ReservationController::class, 'cancel']);
    Route::put('/{reservation}', [ReservationController::class, 'update']);
});

