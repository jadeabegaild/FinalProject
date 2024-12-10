<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Customer\RentedVehicleController as CustomerRentedVehicleController;
use App\Http\Controllers\Admin\RentedVehicleController as AdminRentedVehicleController;
use App\Http\Controllers\Admin\SalesReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/vehicle', VehicleController::class)->names([
        'index' => 'vehicle.index',
        'create' => 'vehicle.create',
        'store' => 'vehicle.store',
        'show' => 'vehicle.show',
        'edit' => 'vehicle.edit',
        'update' => 'vehicle.update',
        'destroy' => 'vehicle.destroy',
    ]);

    Route::resource('admin/rentedVehicle', AdminRentedVehicleController::class)->names([
        'index' => 'rentedVehicle.index',
        'update' => 'rentedVehicle.update',
    ]);
    Route::get('/admin/sales-report', [SalesReportController::class, 'index'])->name('sales_report.index');


});



Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
   
    Route::resource('customer/rentedVehicle', CustomerRentedVehicleController::class)->names([
        'index' => 'customer.rentedVehicle.index',
        'create' => 'customer.rentedVehicle.create',
        'store' => 'customer.rentedVehicle.store',
        'update' => 'customer.rentedVehicle.update',
        'destroy' => 'customer.rentedVehicle.destroy',

    ])
        ->except(['show']);
    Route::get('customer/rentedVehicle/history', [CustomerRentedVehicleController::class, 'history'])->name('customer.rentedVehicle.history');
    Route::delete('customer/rentedVehicle/{rentedVehicle}/history', [CustomerRentedVehicleController::class, 'destroyHistory'])->name('customer.rentedVehicle.destroyHistory');

});