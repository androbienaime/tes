<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TransactionController;

Route::group(['middleware' => ['auth'], 'prefix'=>'admin', 'as'=>'admin.'], function()  {
    Route::resource('customer', 'App\Http\Controllers\Admin\CustomerController');
    Route::resource('deposit', 'App\Http\Controllers\Admin\DepositController')->only(['store', 'index', 'edit']);
    Route::resource('withdraw', 'App\Http\Controllers\Admin\WithdrawController')->only(['store', 'index', 'edit']);
    Route::resource('payment', 'App\Http\Controllers\Admin\PaymentController')->only(['store', 'index', 'edit']);
    Route::resource('account', 'App\Http\Controllers\Admin\AccountController');
    Route::resource('account', 'App\Http\Controllers\Admin\AccountController');

    Route::group(['middleware' => "can:access-settings"], function (){
        Route::resource('typeofaccount', 'App\Http\Controllers\Admin\TypeOfAccountController');
        Route::resource('branch', 'App\Http\Controllers\Admin\BranchController');
        Route::resource('employee', 'App\Http\Controllers\Admin\EmployeeController');
        Route::resource('report', 'App\Http\Controllers\Admin\ReportController');

        Route::resource('transaction', 'App\Http\Controllers\Admin\TransactionController')->only(['destroy', 'edit']);

        Route::put('password', [EmployeeController::class, 'updatePassword'])->name('employee.updatePassword');

        Route::get('branch/report/history/{branch}', [ReportController::class, 'showBranchHistory'])->name("branch.show.history");

        Route::get('employee/report/history/{employee}', [ReportController::class, 'showEmployeeHistory'])->name("employee.show.history");
        Route::get('employee/beforedelete/{employee}', [EmployeeController::class, 'beforedestroy'])->name("employee.beforedestroy");

        // Account Activity
        Route::get('account/history/{account}', [AccountController::class, 'showAccountHistory'])->name("account.show.history");

        Route::get('/address', [AddressController::class, 'index'])->name("address.index");

        Route::get('/api/getmonthlyaverage', [ReportController::class, 'getmonthlyaverage']);

    });

    Route::get('/api/getcustomers', [CustomerController::class, 'getcustomers']);

});
