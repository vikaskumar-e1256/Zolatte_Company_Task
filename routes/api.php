<?php

use App\Http\Controllers\CustomCronJobController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cron-jobs', [CustomCronJobController::class, 'index']);
Route::post('/cron-jobs', [CustomCronJobController::class, 'store']);
Route::delete('/cron-jobs/{schedule:id}', [CustomCronJobController::class, 'destroy']);
