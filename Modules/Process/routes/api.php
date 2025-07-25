<?php

use Illuminate\Support\Facades\Route;
use Modules\Process\Http\Controllers\Admin\PositionAdminController;
use Modules\Process\Http\Controllers\Admin\ProcessAdminController;
use Modules\Process\Http\Controllers\Admin\ElectionAdminController;
use Modules\Process\Http\Controllers\ProcessController;

use Modules\Process\Http\Controllers\Admin\CandidateAdminController;
use Modules\Process\Http\Controllers\Admin\OrganizationAdminController;

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

Route::get('processes/current', [ProcessController::class, 'showCurrent']);
Route::get('processes', [ProcessController::class, 'index'])->name('processes.index');
Route::get('process/{id}', [ProcessController::class, 'show'])->name('processes.show');


Route::prefix('admin')->group(function (){
    // Processes
    Route::get('processes', [ProcessAdminController::class, 'index'])->name('processes.admin.index');
    Route::get('processes/select', [ProcessAdminController::class, 'toSelect'])->name('processes.admin.select');
    Route::get('processes/select-with-relation', [ProcessAdminController::class, 'toSelectWithRelation'])->name('processes.admin.select_with_relation');
    Route::get('processes/{id}', [ProcessAdminController::class, 'show'])->name('processes.admin.show');
    Route::post('processes', [ProcessAdminController::class, 'store']);
    Route::put('processes/{id}', [ProcessAdminController::class, 'update']);
    Route::delete('processes/{id}', [ProcessAdminController::class, 'destroy']);
    // Organizations
    Route::get('organizations/select', [OrganizationAdminController::class, 'toSelect'])->name('organizations.admin.select');
    Route::get('organizations/select-from-process', [OrganizationAdminController::class, 'toSelectFromProcess'])->name('organizations.admin.select_from_process');
    // Elections
    Route::get('elections', [ElectionAdminController::class, 'index'])->name('elections.admin.index');
    Route::get('elections/select', [ElectionAdminController::class, 'toSelect'])->name('elections.admin.select');
    Route::get('elections/{id}', [ElectionAdminController::class, 'show'])->name('elections.admin.show');
    Route::post('elections', [ElectionAdminController::class, 'store']);
    Route::put('elections/{id}', [ElectionAdminController::class, 'update']);
    Route::delete('elections/{id}', [ElectionAdminController::class, 'destroy']);
    // Positions
    Route::get('positions', [PositionAdminController::class, 'index'])->name('positions.admin.index');
    Route::get('positions/{id}', [PositionAdminController::class, 'show'])->name('positions.admin.show');
    Route::post('positions', [PositionAdminController::class, 'store']);
    Route::put('positions/{id}', [PositionAdminController::class, 'update']);
    Route::delete('positions/{id}', [PositionAdminController::class, 'destroy']);
    // Candidates
    Route::get('candidates', [CandidateAdminController::class, 'index'])->name('candidates.admin.index');
    Route::post('candidates', [CandidateAdminController::class, 'store']);
});
