<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\AddressController;

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

Route::get('/get-provinces', [AddressController::class, 'getProvinces']);
Route::get('/get-districts', [AddressController::class, 'getDistricts']);
Route::get('/get-sub-districts', [AddressController::class, 'getSubDistricts']);
Route::get('/get-sub-district', [AddressController::class, 'getSubDistrict']);