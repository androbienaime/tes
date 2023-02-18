<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;

Route::group(['middleware' => ['auth'], 'prefix'=>'admin', 'as'=>'admin.'], function()  {
    Route::get('/registerCustomer', [CustomerController::class, 'create'])->name('customer');
    Route::post('/registerCustomer', [CustomerController::class, 'createCustomer'])->name('createCustomer');

    Route::resource('branch', 'App\Http\Controllers\Admin\BranchController')->only(['store', 'index']);
});
