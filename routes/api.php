<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use http\Client\Request;
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
        Route::apiResource( '/', ProductController::class );

        Route::apiResource( '/{product}/reviews', ReviewController::class );
    } );

    Route::group( [ 'prefix' => 'users' ], function () {
        Route::apiResource( '/', UserController::class );

        Route::apiResource( '/{user}/orders', OrderController::class );
    } );

    Route::apiResource( '/product_categories', CategoryController::class );
} );


Route::group( [ 'prefix' => 'products' ], function () {
    Route::get( '/', [ ProductController::class, 'index' ] );

    Route::get( '/{product}/reviews', [ ReviewController::class, 'index' ] )->name( 'reviews.index' );
} );


Route::get( '/categories/', [ CategoryController::class, 'index' ] );

Route::post( 'register', [ RegisterController::class, 'register' ] )->name( 'register' );
Route::post( 'login', [ LoginController::class, 'login' ] )->name( 'login' );



Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'https://laravel-store.com/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://passport-app.test/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $response = Http::asForm()->post('http://passport-app.test/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'redirect_uri' => 'https://laravel-store.com/callback',
        'code' => $request->code,
    ]);

    return $response->json();
});
