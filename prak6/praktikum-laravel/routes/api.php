<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::post("/v1/register", [AuthController::class,'register']);
Route::post("/v1/login", [AuthController::class,'login']);

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::prefix("v1")->group(function () {
        Route::apiResource("product", ProductController::class);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
