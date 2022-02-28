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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/email',[\App\Http\Controllers\Api\EmailController::class,'index']);
Route::post('/email/bulk',[\App\Http\Controllers\Api\EmailController::class,'bulk']);
Route::post('/pending',[\App\Http\Controllers\Api\EmailController::class,'show']);








