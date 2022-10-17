<?php

use App\Http\Controllers\Api\{AuthController, ReceiverController, TransactionController, UserController};
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

Route::group(['middleware' => ['validate.rest.token', 'enable.cors']], function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('transaction')->group(function () {
            Route::post('add', [TransactionController::class, 'addTransaction']);
        });
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'getUser']);
        });
        Route::get('receivers/{nik}', [ReceiverController::class, 'show']);
    });

});
