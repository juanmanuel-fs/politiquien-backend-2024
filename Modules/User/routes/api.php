<?php

use App\Enums\HttpStatus;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;

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


Route::get('user', [AuthController::class, 'index'])->name('user.index');
Route::get('store', function (){
    return HttpStatus::OK->value;
});

Route::post('auth/login', [AuthController::class, 'login']);

