<?php

namespace App\Http\Controllers\Admin;

use App\Events\RegisteredBranchEvent;
use App\Models\Branch;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index(){
        return view("adminTheme.Branch.branch");
    }


    public function create(){

    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:20',
            'code' => 'unique:branches',
            'state' => 'required|min:3|max:20',
            'city' => 'required|min:3|max:20',
            'address1' => 'required|min:3|max:50',
            'phone' => 'required|min:8'
        ]);

        $branch = new Branch();
        $address = new Address();

        $address->state = $request->state;
        $address->country = "Haiti";
        $address->city = $request->city;
        $address->address1 = $request->address1;
        $address->phone = $request->phone;

        $branch->name = $request->name;
        $branch->code = "LT-".$this->genBranchCode();


        $address->save();
        $address->Branch()->save($branch);

        // $event = event(new RegisteredBranchEvent($branch));

        return back()->with("status", __("Branch save successfully"));
    }

    private function genBranchCode(){
        $this->code = [
            'code' => mt_rand(100, 999)
        ];

        $rules = ['code' => 'unique:branches'];

        $validate = Validator::make($this->code, $rules)->passes();

        return $validate ? $this->code['code'] : $this->genBranchCode();
    }
}
