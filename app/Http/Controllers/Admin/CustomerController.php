<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function create(Request $request): View
    {
        return view("adminTheme.Customer.register");
    }

    public function createCustomer(Request $request){
        dd($request->first_name);
    }
}
