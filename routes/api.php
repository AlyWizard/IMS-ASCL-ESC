<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkspaceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Workspace API routes
Route::get('/workstation/{id}', [WorkspaceController::class, 'getWorkstation']);
Route::get('/server/{id}', [WorkspaceController::class, 'getServer']);
Route::get('/boardroom/{id}', [WorkspaceController::class, 'getBoardroom']);

// Disregard the esc part because we are working with another company