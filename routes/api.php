<?php

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



Route::middleware('auth:api')
    ->group(function() {
        Route::apiResources([
            'pairingRequest' => \App\Http\Controllers\PairingRequestController::class,
            'users' => \App\Http\Controllers\UserController::class,
            '/users/{user}/pairingRequests' => \App\Http\Controllers\UserPairingRequestController::class
        ]);
    });

