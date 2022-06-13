<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

Route::middleware( 'auth:sanctum' )->group( function () {
    Route::group( [ 'prefix' => 'products' ], function () {
        Route::resource( '/', ProductController::class );
        Route::put( '/{product}/', [ ProductController::class, 'update' ] );
        Route::delete( '/{product}/', [ ProductController::class, 'destroy' ] );

        Route::resource( '/{product}/reviews', ReviewController::class );
        Route::resource( '/{product}/reviews', ReviewController::class );
        Route::post( '/{product}/reviews/', [ ReviewController::class, 'store' ] );
        Route::put( '/{product}/reviews/{review}', [ ReviewController::class, 'update' ] );
        Route::delete( '/{product}/reviews/{review}', [ ReviewController::class, 'destroy' ] );

        Route::resource( '/{product}/categories', CategoryController::class );
        Route::post( '/{product}/categories/', [ CategoryController::class, 'store' ] );
        Route::put( '/{product}/categories/{category}', [ CategoryController::class, 'update' ] );
        Route::delete( '/{product}/categories/{category}', [ CategoryController::class, 'destroy' ] );
    } );

    Route::group( [ 'prefix' => 'users' ], function () {
        Route::resource( '/', UserController::class );
        Route::put( '/{user}/', [ UserController::class, 'update' ] );
        Route::delete( '/{user}/', [ UserController::class, 'destroy' ] );

        Route::resource( '/{user}/orders', OrderController::class );
        Route::post( '/{user}/orders/', [ OrderController::class, 'store' ] );
        Route::put( '/{user}/orders/{order}', [ OrderController::class, 'update' ] );
        Route::delete( '/{user}/orders/{order}', [ OrderController::class, 'destroy' ] );
    } );
} );


Route::group( [ 'prefix' => 'products' ], function () {
    Route::get( '/', [ ProductController::class, 'index' ] );

    Route::get( '/{product}/reviews', [ ReviewController::class, 'index' ] )->name( 'reviews.index' );

    Route::get( '/{product}/categories', [ CategoryController::class, 'index' ] );
} );

Route::group( [ 'prefix' => 'users' ], function () {
    Route::get( '/', [ UserController::class, 'index' ] );

    Route::get( '/{user}/orders', [ OrderController::class, 'index' ] );
} );

Route::post( 'register', [ RegisterController::class, 'register' ] )->name( 'register' );
Route::post( 'login', [ LoginController::class, 'login' ] )->name( 'login' );

