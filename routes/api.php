<?php

use App\Http\Controllers\Assetassignment;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class,"login"]);
    Route::post("/register",[AuthController::class,'register']);
    Route::post('/logout', [AuthController::class,"logout"]);
    Route::post('/refresh', [AuthController::class,"refresh"]);
    Route::post('/me', [AuthController::class,"me"]);
    Route::get("/joker", [AuthController::class,"joker"]);
    Route::post("/insertasset", [AssetController::class,"insertasset"]);
    Route::post("/vendor", [VendorController::class,"vendor"]);
    Route::post("/Assetassign", [Assetassignment::class,"Assetassign"]);
});

// for the mailling service i used mailchip
