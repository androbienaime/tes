<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeOfAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("adminTheme.Account.typeofaccount");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeOfAccount  $typeOfAccount
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfAccount $typeOfAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeOfAccount  $typeOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $typeofaccount = TypeOfAccount::find($request->id);
        if($typeofaccount->count() <= 0){
            abort(404);
        }

        return view("adminTheme.Account.TypeOfAccount.edit", [
           'typeofaccount' => $typeofaccount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeOfAccount  $typeOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfAccount $typeOfAccount)
    {
        $typeOfAccount = TypeOfAccount::find($request->typeofaccount);
        if($typeOfAccount->count() <= 0){
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'price' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'active_case_payment' => "required",
            'prefix' => 'required|min:2|max:2'
        ]);

        $typeOfAccount->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'active_case_payment' => $request->active_case_payment,
            'prefix' => $request->prefix
        ]);


        return back()->with("status", __("updated successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeOfAccount  $typeOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfAccount $typeOfAccount)
    {
        //
    }

    public function destroy2(Request $request){
        //
    }
}
