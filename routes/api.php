<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiQuotesConnectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuotesController;

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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});

Route::middleware('auth:api')->group(function () {
    Route::middleware('throttle:30,1')->group(function () {
        Route::controller(ApiQuotesConnectionController::class)->group(function () {
            Route::get('random-quotes', 'fiveRandomQuotes');
            Route::get('quotes-by-kayne-west/{limit}', 'randomQuotesByKayneWest');
            Route::get('refresh-quotes', 'refreshQuotes');
        });
    });
    
    Route::controller(QuotesController::class)->group(function () {
        Route::get('favorites-quotes/{id}', 'favoritesQuotes');
        Route::post('save-quote', 'addFavoriteQuote');
        Route::delete('delete-quote/{id}', 'deleteFavoriteQuote');
    });
    
    Route::controller(UserController::class)->group(function () {
        Route::post('update-profile', 'updateProfile');
        Route::post('block-user', 'blockUser');
    });   
});

 