<?php

namespace App\Http\Controllers\Admin;

use AndroLT\Countrypkg\Models\City;
use AndroLT\Countrypkg\Models\Country;
use AndroLT\Countrypkg\Models\State;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Nette\Schema\ValidationException;
use Illuminate\Validation\Rules;


class EmployeeController extends Controller
{
    protected $countries;
    protected $states;
    protected $cities;
    protected $branches;
    protected $roles;

    public function __construct(){
        $this->countries = Country::all();

        $ht_id =  Country::where('name', 'Haiti')->first()->id;
        $nd_id = State::where('name', 'Nord-Est')->first()->id;

        $this->states = State::where('country_id', $ht_id)->get();
        $this->cities = City::where('state_id', $nd_id)->get();

        $this->roles = Role::all();
        $this->branches = Branch::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("adminTheme.Team.Employee.employee");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("adminTheme.Team.Employee.register", [
            "countries" => $this->countries,
            "states" => $this->states,
            "roles" => $this->roles,
            "branches" => $this->branches
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'unique:accounts',
            'last_name' => 'required|min:3',
            'first_name' => 'required|min:3',
            'nickname' => 'required|min:2',
            'gender' => 'required',
            'identity_number' => 'nullable|min:10',
            'country' => 'required',
            'city' => 'required',
            'phone' => 'nullable|min:8',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();

        DB::beginTransaction();

        try {
            $user->name = $request->nickname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->roles()->sync($request->role);

            $address = new Address();
            $address->city = $request->city;
            $address->country = $request->country;
            $address->state = $request->state;
            $address->phone = $request->phone;
            $address->save();

            Employee::create([
               "firstname" => $request->first_name,
                "lastname" => $request->last_name,
                "user_id" => $user->id,
                "gender" => $request->gender,
                "identity_number" => $request->identity_number,
                "branch_id" => $request->branch,
                "address_id" => $address->id
            ]);

        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

        return back()->with("status", "Employee saved succesfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view("adminTheme.Team.Employee.edit",[
            'employee' => $employee,
            "countries" => $this->countries,
            "states" => $this->states,
            "branches" => $this->branches,
            "roles" => $this->roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return RedirectResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($employee->user->id)],
            'last_name' => 'required|min:3',
            'first_name' => 'required|min:3',
            'nickname' => 'required|min:3',
            'gender' => 'required',
            'identity_number' => 'nullable|min:10',
            'country' => 'required',
            'city' => 'required',
            'phone' => 'nullable|min:8',
        ]);


        DB::beginTransaction();

        try {


            $employee->user()->update([
                'name' => $request->nickname,
                'email' => $request->email
            ]);

            $employee->user->roles()->sync($request->role);

            $employee->address()->update([
                'city' => $request->city,
                'country' => $request->country,
                'state' => $request->state,
                'phone' => $request->phone
            ]);

            $employee->update([
                "firstname" => $request->first_name,
                "lastname" => $request->last_name,
                "gender" => $request->gender,
                "identity_number" => $request->identity_number,
                "branch_id" => $request->branch,
            ]);

        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

        return Redirect::route('admin.employee.edit', $employee)->with('status', __('Your change has been made successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employee $employee)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $userDeleted = DB::table("users")->where("id", "=", $employee->user_id)->first();

        $user = $request->user();

        if ($userDeleted->deleted_at == null){
            if ($user == $employee->user()->first()) {
                return back()->with("error", "Error deteled");
            } else {
                $employee->user()->first()->delete();
                $message = __("Employee deteled succesfully.");
            }
        }else{
            $message = __("The employee has been restored succesfully.");
            $userDeleted->deleted_at = null;
            DB::table("users")->where("id", "=", $employee->user_id)->update([
                "deleted_at" => null
            ]);
        }

        return back()->with("status", $message);

    }

    public function updatePassword(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $employee->user()->update([
            'password' => Hash::make($validated['password']),
            'first_time_login' => 1
        ]);

        return back()->with('status', 'Your change has been made successfully');
    }

    public function beforedestroy(Employee $employee)
    {
        $userDeleted = false;
        $user = DB::table("users")->where("id", "=", $employee->user_id)->first();

        if($user->deleted_at != null){
            $userDeleted = true;
        }
        return view("adminTheme.Team.Employee.destroy", [
            "employee" => $employee,
            "userDeleted" => $userDeleted
        ]);
    }
}
