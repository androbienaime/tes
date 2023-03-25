<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeOfAccount;
use Illuminate\Http\Request;

class TypeOfAccountController extends Controller
{
    public function index(){

        return view("AdminTheme.Account.typeofaccount");
    }

    public function store(Request $request){
        $validated = $request->validate([
           'name' => 'unique:type_of_accounts|required|min:3|max:20',
            'price' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'active_case_payment' => "required",
            'prefix' => 'required|min:2|max:2'
        ]);

        $typeofaccount = TypeOfAccount::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'active_case_payments' => $request->active_case_payment,
            'prefix' => $request->prefix
        ]);

        return back()->with("status", __("Type of account save successfully"));
    }
}
