<?php

use App\Models\VehicleOrders;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PemasanganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\VehicleOrderController;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('login', [AuthController::class,'index'])->name('login-index');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('login', [AuthController::class,'login'])->name('login');

// Route::get('/', function () {
//     return redirect()->route('dashboard');
// });

// Route::prefix('user')->group(function() {
//     Route::get('login', [AuthController::class, 'index'])->name('login.index');
//     Route::post('login', [AuthController::class, 'login'])->name('login');
// });

Route::middleware('log')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('companies')->group(function() {
        Route::get('/', [CompanyController::class, 'index'])->name('companies');
        Route::get('create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('insert', [CompanyController::class, 'insert'])->name('companies.insert');
        Route::get('edit/{id?}', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::get('view/{id?}', [CompanyController::class, 'view'])->name('companies.view');
        Route::post('update/{id?}', [CompanyController::class, 'update'])->name('companies.update');
        Route::get('delete/{id?}', [CompanyController::class, 'destroy'])->name('companies.delete');
    });
    
    Route::prefix('vehicles')->group(function() {
        Route::get('/', [VehicleController::class, 'index'])->name('vehicles');
        Route::get('create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('insert', [VehicleController::class, 'insert'])->name('vehicles.insert');
        Route::get('edit/{id?}', [VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::get('view/{id?}', [VehicleController::class, 'view'])->name('vehicles.view');
        Route::post('update/{id?}', [VehicleController::class, 'update'])->name('vehicles.update');
        Route::get('delete/{id?}', [VehicleController::class, 'destroy'])->name('vehicles.delete');
    });
    
    Route::prefix('vehicle-usages')->group(function() {
        Route::get('/', [VehicleOrderController::class, 'index'])->name('vehicle_usage');
        Route::get('create', [VehicleOrderController::class, 'create'])->name('vehicle_usage.create');
        Route::post('store', [VehicleOrderController::class, 'insert'])->name('vehicle_usage.insert');
        Route::get('edit/{id?}', [VehicleOrderController::class, 'edit'])->name('vehicle_usage.edit');
        Route::get('view/{id?}', [VehicleOrderController::class, 'view'])->name('vehicle_usage.view');
        Route::post('update/{id?}', [VehicleOrderController::class, 'update'])->name('vehicle_usage.update');
        Route::get('delete/{id?}', [VehicleOrderController::class, 'destroy'])->name('vehicle_usage.delete');
        Route::get('approve/{id?}', [VehicleOrderController::class, 'approve'])->name('vehicle_usage.approve');
        Route::post('approved/{id?}', [VehicleOrderController::class, 'approved'])->name('vehicle_usage.approved');
        Route::get('export', [VehicleOrderController::class, 'export'])->name('vehicle_usage.export');
        Route::post('approved-by-officer/{id?}', [VehicleOrderController::class, 'approvedByOfficer'])->name('vehicle_usage.approved-by-officer');
        Route::get('reject/{id?}', [VehicleOrderController::class, 'reject'])->name('vehicle_usage.reject');
    });

    Route::prefix('monitoring')->group(function() {
        Route::get('/', [MonitoringController::class, 'index'])->name('monitoring');
    });

    Route::prefix('log-activity')->group(function() {
        Route::get('/', [LogActivityController::class, 'index'])->name('log-activity');
    });

    Route::get('profile/{id}', [UserController::class, 'index'])->name('profile');
    Route::put('profile/{id}', [UserController::class, 'profile'])->name('profile.update');

});
