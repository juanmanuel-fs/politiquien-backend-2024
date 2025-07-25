<?php

use Illuminate\Support\Facades\Route;
use Modules\Utility\Http\Controllers\Admin\UtilityAdminController;

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

Route::get('utility', function (){
    return file_get_contents(getcwd().'/init/states.json');
});


Route::prefix('admin')->group(function (){
    // Processes
    Route::get('utility/states/select', [UtilityAdminController::class, 'statesSelect'])->name('utilities.admin.states.select');
    Route::get('utility/provinces/{id}/select', [UtilityAdminController::class, 'provincesSelect'])->name('utilities.admin.provinces.select');
});