<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
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

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/feedback/list', [FeedbackController::class, 'index']);

Route::get('/feedback/{id}', [FeedbackController::class, 'show']);

Route::get('/feedback/tag/{id}', [FeedbackController::class, 'filter']);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/feedback/create', [FeedbackController::class, 'store']);
    Route::put('/feedback/edit/{id}', [FeedbackController::class, 'update']);
});
