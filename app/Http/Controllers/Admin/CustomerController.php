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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class CustomerController extends Controller
{
    private  $countries;
    private $states;
    private $cities;
    private $typeofaccount;

    public function __construct(){
        try{
            $this->countries = Country::all();

            $ht_id =  Country::where('name', 'Haiti')->first()->id;
            $nd_id = State::where('name', 'Nord-Est')->first()->id;

            $this->states = State::where('country_id', $ht_id)->get();
            $this->cities = City::where('state_id', $nd_id)->get();
            $this->typeofaccount = TypeOfAccount::all();

        }catch (\Exception $e){
            abort(403);
        }


    }
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view("adminTheme.Customer.register", [
            'countries' => $this->countries,
            'states' => $this->states,
            'cities' => $this->cities,
            'typeofaccounts' => $this->typeofaccount
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            'phone' => 'nullable|integer|min:8'
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
            $customer->employee_id = Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id;
            $customer->address_id = $address->id;
            $customer->save();


            $account = new Account();
            $account->code = Account::genAccountsCode();
            $account->type_of_account_id = $request->typeofaccount;
            $account->customer_id = $customer->id;
            $account->balance = 0;
            $account->employee_id = Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id;
            $account->state = true;
            $account->save();

        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

       return back()->with("status", __("Customer saved successfully"));
   }

    /**
     * @param Request $request
     * @return void
     */
    public function edit(Customer $customer){

        if(Gate::denies("access-update-customer")){
            return back();
        }

        return view("adminTheme.Customer.edit",[
            'customer' => $customer,
            "countries" => $this->countries,
            "states" => $this->states,
            'typeofaccounts' => $this->typeofaccount
        ]);
   }

   public function update(Request $request, Customer $customer){
       $request->validate([
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

       try {

           $customer->address->update([
               'email' => $request->email,
               'country' => $request->country,
               'city' => $request->city,
               'phone' => $request->phone,
               'state' => $request->state
           ]);


           $customer->update([
                'name' => $request->last_name,
               'firstname' => $request->first_name,
               'gender' => $request->gender,
               'identity_number' => $request->identity_number
           ]);

       }catch (ValidationException $e){
           DB::rollBack();
           return back()->with("status", __("Error" + $e->getMessage()));
       }

       DB::commit();

       return back()->with("status", __("Customer update successfully"));
   }

    /**
     * @return mixed
     */
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
