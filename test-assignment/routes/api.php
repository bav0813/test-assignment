<?php

use App\Http\Controllers\BusinessController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-businesses', [BusinessController::class, 'getBusinesses']);
Route::get('/get-business/{id}', [BusinessController::class, 'getBusiness']);
Route::post('/store-business', [BusinessController::class, 'storeBusiness']);
Route::put('/update-business', [BusinessController::class, 'updateBusiness']);
Route::delete('/delete-business/{id}', [BusinessController::class, 'deleteBusiness']);

