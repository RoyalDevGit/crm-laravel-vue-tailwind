<?php

use App\Http\Controllers\Api\v1\CompanyController;
use App\Http\Controllers\Api\v1\PasswordChange;
use App\Http\Controllers\Api\v1\PersonController;
use App\Http\Controllers\Api\v1\ProfileUpdateController;
use App\Http\Controllers\Api\v1\UserController;
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

Route::middleware('auth:api')->group(function () {

    Route::get('/logout',[UserController::class,'logout']);
    Route::put('/profile-update',ProfileUpdateController::class);
    Route::put('/password-reset',PasswordChange::class);
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/company', CompanyController::class);
    Route::apiResource('/persons', PersonController::class);


});
