<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;

Route::group(['middleware' => ['auth'], 'prefix'=>'admin', 'as'=>'admin.'], function()  {
    Route::resource('branch', 'App\Http\Controllers\Admin\BranchController')->only(['store', 'index', 'edit']);
    Route::resource('customer', 'App\Http\Controllers\Admin\CustomerController')->only(['store', 'index', 'edit']);
    Route::resource('typeofaccount', 'App\Http\Controllers\Admin\TypeOfAccountController')->only(['store', 'index', 'edit']);
    Route::resource('account', 'App\Http\Controllers\Admin\AccountController')->only(['store', 'index', 'edit']);
    Route::resource('deposit', 'App\Http\Controllers\Admin\DepositController')->only(['store', 'index', 'edit']);

    Route::get('/api/getcustomers', [CustomerController::class, 'getcustomers']);

});
