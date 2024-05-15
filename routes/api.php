<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\TruckTrackingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

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
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::post("/login", [AuthenticationController::class, "login"]);

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(TruckTrackingController::class)->group(function () {
            Route::get("/getAll", "getAllData");
            Route::get("/getById/{id}", "getById");
            Route::post("/saveTrack", "store");
            Route::put("/updateTrack/{id}", "update");
            Route::delete("/delete/{id}", "destroy");
        });
    });
});