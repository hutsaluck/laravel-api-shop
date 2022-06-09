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
Route::prefix('user')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'products'],function(){
        Route::apiResource('/', App\Http\Controllers\ProductController::class);
        Route::apiResource('/{product}/reviews',App\Http\Controllers\ReviewController::class);
    });
});



Route::post('register', [App\Http\Controllers\API\RegisterController::class, 'register'])->name('register');
Route::post('login', [App\Http\Controllers\API\RegisterController::class, 'login'])->name('login');

