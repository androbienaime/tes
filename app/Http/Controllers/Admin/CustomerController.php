<?php

namespace App\Http\Controllers\Admin;

use AndroLT\Countrypkg\Models\City;
use AndroLT\Countrypkg\Models\Country;
use AndroLT\Countrypkg\Models\State;
use App\Http\Livewire\TypeOfAccountTable;
use App\Models\Account;
use App\Models\Address;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Employee;
use App\Models\TypeOfAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $countries = Country::all();
        $states = State::all();

        $ht_id =  Country::where('name', 'Haiti')->get();
        $nd_id = State::where('name', 'Nord-Est')->get();

        $states = State::where('country_id', $ht_id[0]->id)->get();
        $cities = City::where('state_id', $nd_id[0]->id)->get();

        $typeofaccount = TypeOfAccount::all();


        return view("adminTheme.Customer.register", [
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'typeofaccounts' => $typeofaccount
        ]);
    }

   public function store(Request $request){

        $request->validate([
            'code' => 'unique:accounts',
           'last_name' => 'required|min:3',
           'first_name' => 'required|min:3',
           'gender' => 'required',
           'identity_number' => 'nullable|integer|min:10',
            'email' => 'nullable',
            'country' => 'required',
            'city' => 'required',
            'phone' => 'nullable|integer'
        ]);


        DB::beginTransaction();

        try{
            $address = new Address();
            $address->country = $request->country;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->phone = $request->phone;
            $address->email = $request->email;
            $address->save();

            $customer = new Customer();
            $customer->code = $this->genCustomerCode();
            $customer->name = $request->last_name;
            $customer->firstname = $request->first_name;
            $customer->gender = $request->gender;
            $customer->identity_number = $request->identity_number;
            $customer->employee_id = Employee::where('user_id', Auth::user()->getAuthIdentifier())->get()[0]->id;
            $customer->address_id = $address->id;
            $customer->save();


            $account = new Account();
            $account->code = Account::genAccountsCode();
            $account->type_of_account_id = $request->typeofaccount;
            $account->customer_id = $customer->id;
            $account->balance = 0;
            $account->state = true;
            $account->save();

        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

       return back()->with("status", __("Customer save successfully"));
   }

    private function genCustomerCode(){
        $this->code = [
            'code' => mt_rand(100, 999)
        ];

        $rules = ['code' => 'unique:customers'];

        $validate = Validator::make($this->code, $rules)->passes();

        return $validate ? $this->code['code'] : $this->genCustomerCode();
    }

    public function getcustomers(Request $request){
        if(strlen($request->search) > 1 ) {
            $req = '%' . $request->search . '%';
            $c = Customer::where("name", 'like', $req)
                ->orWhere("firstname", "like", $req)
                ->orWhere("code", "like", $req)->get();

            if (count($c) > 0) {
                $customers = $c;

            } else {
                $customers = [];
            }

            return json_encode($customers, true);
        }

    }


}
