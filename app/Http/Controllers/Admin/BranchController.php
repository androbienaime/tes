<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Address;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function branch(): View{
        return view("adminTheme.Branch.branch");
    }

    public function save(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:20',
            'code' => 'unique:branches'
        ]);

        $branch = new Branch();
        $address = new Address();
        $address->city = "TRFFF";
        $address->country = "TRFFF";
        $address->email = "TRFFF";
        $address->phone = "TRFFF";

        // $address = Branch->Address::create([
        //     'country' => $request->country,
        //     'city' => $request->city,
        //     'phone' => $request->phone
        // ]);

        // $branch = Branch::create([
        //     'name' => $request->name,
        //     'code' => $request->code,
        // ]);
        
        $branch->name = $request->name;
        $branch->code = "kkk";
       $address->save();
        $address->Branch()->save($branch);
        
        return view("adminTheme.Branch.branch");
    }
}
