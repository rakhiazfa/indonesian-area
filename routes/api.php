<?php

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\VillageController;
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

Route::apiResource('provinces', ProvinceController::class);

Route::get('provinces/{province}/regencies', [ProvinceController::class, 'regencies']);

Route::apiResource('regencies', RegencyController::class);

Route::get('regencies/{regency}/districts', [RegencyController::class, 'districts']);

Route::apiResource('districts', DistrictController::class);

Route::get('districts/{district}/villages', [DistrictController::class, 'villages']);

Route::apiResource('villages', VillageController::class);
