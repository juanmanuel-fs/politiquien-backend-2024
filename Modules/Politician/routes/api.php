<?php

use Illuminate\Support\Facades\Route;
use Modules\Politician\Http\Controllers\Admin\PoliticianController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('politician', PoliticianController::class)->names('politician');
});
