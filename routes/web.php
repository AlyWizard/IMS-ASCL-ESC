<?php
// File: routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EscController;
use App\Http\Controllers\AllianceController;
use App\Http\Controllers\EscAuthController;
use App\Http\Controllers\AllianceAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main landing page (company selection)
Route::get('/', [HomeController::class, 'index'])->name('home');

// ESC Routes
Route::prefix('esc')->group(function () {
    // Show company page
    Route::get('/', [EscController::class, 'index'])->name('esc.index');
    
    // Authentication routes
    Route::get('/login', [EscAuthController::class, 'showLogin'])->name('esc.login');
    Route::post('/login', [EscAuthController::class, 'login']);
    Route::post('/logout', [EscAuthController::class, 'logout'])->name('esc.logout');
    
    // Protected routes (need authentication)
    Route::middleware('auth:esc')->group(function () {
        Route::get('/dashboard', [EscController::class, 'dashboard'])->name('esc.dashboard');
        // Add more protected routes here
    });
});

// Alliance Routes
Route::prefix('alliance')->group(function () {
    // Show company page
    Route::get('/', [AllianceController::class, 'index'])->name('alliance.index');
    
    // Authentication routes
    Route::get('/login', [AllianceAuthController::class, 'showLogin'])->name('alliance.login');
    Route::post('/login', [AllianceAuthController::class, 'login']);
    Route::post('/logout', [AllianceAuthController::class, 'logout'])->name('alliance.logout');
    
    // Protected routes (need authentication)
    Route::middleware('auth:alliance')->group(function () {
        Route::get('/dashboard', [AllianceController::class, 'dashboard'])->name('alliance.dashboard');
        // Add more protected routes here
    });
});

    // API Routes for ESC
    Route::prefix('api/esc')->group(function () {
        Route::get('/workstation/{id}', [App\Http\Controllers\EscApiController::class, 'getWorkstationDetails']);
});

    // In routes/web.php
    Route::middleware('auth:esc')->group(function () {
        Route::get('/dashboard', [EscController::class, 'dashboard'])->name('esc.dashboard');
});

// Newly added routes para sa ibang funtions

// Get workstation details
Route::get('/esc/workstation/{id}', [App\Http\Controllers\EscApiController::class, 'getWorkstationDetails']);

// Get all workstations
Route::get('/esc/workstations', [App\Http\Controllers\EscApiController::class, 'getAllWorkstations']);

// Get workstation statuses for color coding
Route::get('/esc/workstations/status', [App\Http\Controllers\EscApiController::class, 'getWorkstationStatuses']);

// Update workstation details
Route::put('/esc/workstation/{id}', [App\Http\Controllers\EscApiController::class, 'updateWorkstation']);

// Transfer workstation
Route::post('/esc/workstation/transfer', [App\Http\Controllers\EscApiController::class, 'transferWorkstation']);

//end of the workstation functions