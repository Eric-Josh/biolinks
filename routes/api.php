<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInvitationController;
use App\Http\Controllers\ProjectLinksController;

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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::put('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::put('/password/update', [ProfileController::class, 'updatePassword']);
    Route::post('/logout', [LogoutController::class, 'logout']);

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::group(['prefix' => 'project'], function () {
        Route::post('/store', [ProjectController::class, 'store']);
        Route::get('/show/{projectId}', [ProjectController::class, 'show']);
        Route::put('/update/{projectId}', [ProjectController::class, 'update']);
        Route::delete('/delete/{projectId}', [ProjectController::class, 'delete']);
        Route::post('/invitation', [ProjectInvitationController::class, 'sendInvitation']);
    });

    Route::get('/links', [ProjectLinksController::class, 'index']);
    Route::group(['prefix' => 'link'], function () {
        Route::post('/store', [ProjectLinksController::class, 'store']);
        Route::get('/show/{linkId}', [ProjectLinksController::class, 'show']);
        Route::get('/edit/{id}', [ProjectLinksController::class, 'edit']);
        Route::put('/update/status/{id}', [ProjectLinksController::class, 'updateStatus']);
        Route::post('/duplicate/{id}', [ProjectLinksController::class, 'duplicate']);
        Route::delete('/delete/{id}', [ProjectLinksController::class, 'delete']);
    });
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);