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
            'price' => 'required|integer',
            'duration' => 'required|integer'
        ]);

        $typeofaccount = TypeOfAccount::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration
        ]);

        return back()->with("status", __("Type of transaction save successfully"));
    }
}
