<?php 

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;

    Route::middleware('auth')->group(function () {
        Route::get('/registerCustomer', [CustomerController::class, 'create'])->name('customer');
        Route::post('/registerCustomer', [CustomerController::class, 'createCustomer'])->name('createCustomer');
        Route::get('/branch', [BranchController::class, 'branch'])->name('branch');
        Route::post('/branch', [BranchController::class, 'save'])->name('createBranch');
    });
