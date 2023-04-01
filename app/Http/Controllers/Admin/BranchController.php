<?php

namespace App\Http\Controllers\Admin;

use AndroLT\Countrypkg\Models\Country;
use AndroLT\Countrypkg\Models\State;
use App\Events\RegisteredBranchEvent;
use App\Models\Branch;
use App\Models\Address;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index(){
        $country = Country::where('name', 'Haiti')->first();

        $states = $country->getStates;

        return view("adminTheme.Branch.branch", [
            'states' => $states
        ]);
    }


    public function create(){

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:20|unique:branches',
            'code' => 'unique:branches',
            'state' => 'required|min:3|max:20',
            'city' => 'required|max:20',
            'address1' => 'required|min:3|max:50',
            'phone' => 'required|min:8'
        ]);

        $branch = new Branch();
        $address = new Address();

        $address->state = State::all()->find($request->state)->name;
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

    public function edit(Branch $branch){
        $country = Country::where('name', 'Haiti')->first();
        $states = $country->getStates;


        return view("adminTheme.Branch.edit",
            [
                'states' => $states,
                'branch' => $branch
            ]
        );
    }

    public function update(Request $request, Branch $branch){
        $validated = $request->validate([
            'name' => 'required|min:2|max:20',
            'state' => 'required|min:3|max:20',
            'city' => 'required|max:20',
            'address1' => 'required|min:3|max:50',
            'phone' => 'required|min:8'
        ]);

        $branch->name = $request->name;
        $branch->address->update([
            'state' => $request->state,
            'city' => $request->city,
            'address1' => $request->address1,
            'phone' => $request->phone
        ]);
        $branch->update();

        // $event = event(new RegisteredBranchEvent($branch));

        return back()->with("status", __("Branch update successfully"));
    }

    public function destroy(Request $request, Branch $branch){
        $status = "";
        if($branch->employee()->count() === 0){
            $branch->forceDelete();
            $message = "Branch delete succesfully";
            return redirect()->route("admin.branch.index");
        }else{
            $message = "Sorry, This branch is associated by employeee";
            $status = "error";
        }

        return back()->with($status, __($message));
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
