<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ReviewController;

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

/*Route::middleware( 'auth:sanctum' )->group( function () {
    Route::group( [ 'prefix' => 'products' ], function () {
        Route::apiResource( '/', ProductController::class );
        Route::apiResource( '/{product}/reviews', ReviewController::class );
    } );
} );*/
Route::group( [ 'prefix' => 'products' ], function () {
    Route::apiResource( '/', ProductController::class );
    Route::put( '/update', [ProductController::class, 'update'] );
    Route::apiResource( '/{product}/reviews', ReviewController::class );
} );

Route::group( [ 'prefix' => 'products' ], function () {
    Route::get( '/', [ ProductController::class, 'index' ] );
    Route::get( '/{product}/reviews', [ ReviewController::class, 'index' ] );
} );

Route::post( 'register', [ RegisterController::class, 'register' ] )->name( 'register' );
Route::post( 'login', [ LoginController::class, 'login' ] )->name( 'login' );

