<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\LogoutController;
use App\Http\Controllers\api\AdsController;
use App\Http\Controllers\api\PlansAndMembersController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\FlightBookingController;
use App\Http\Middleware\CustomThrottleMiddleware;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        $request->user()
    ]);
});

// Route::middleware(['guest', 'throttle:6,1'])->post('/register', [RegisteredUserController::class, 'store']);

//////////// Auth routes Start ////////////////////////

Route::middleware(['guest'])->post('/register', [RegisterController::class, 'store']);

Route::middleware(['guest'])->post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);

//////////// Auth routes end ////////////////////////


Route::middleware(['api.auth'])->group(function () {
    Route::get('/google-ads', [AdsController::class, 'googleAds']);
    Route::get('/custom-ads', [AdsController::class, 'customAds']);

    //plans route
    Route::get('/plans/{planId?}', [PlansAndMembersController::class, 'plans']);
    // reviews route
    Route::get('/reviews', [ReviewController::class, 'index']);
    
});

// plans subscription route post 
Route::middleware('auth:sanctum')->post('/plan-subscribe/{planId}', [PlansAndMembersController::class, 'subscribe']);

// reviews route post 

Route::middleware(['custom_throttle','auth:sanctum'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store']);
});
// booking 
Route::prefix('bookings')->middleware(['custom_throttle','api.auth'])->group(function () {
    Route::post('/flight-bookings', [FlightBookingController::class, 'createFlightBooking']);
});
