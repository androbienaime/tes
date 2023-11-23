<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountHistoryResource;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\TypeOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeofaccount = TypeOfAccount::all();

        return view("adminTheme.Account.account", [
            'typeofaccounts' => $typeofaccount
        ]);
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
     * Creation de compte
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'unique:accounts',
            'id' => 'required'
        ]);



        $account = new Account();
        $account->code = Account::genAccountsCode(TypeOfAccount::all()->find($request->typeofaccount));
        $account->type_of_account_id = $request->typeofaccount;
        $account->customer_id = $request->id;
        $account->balance = 0;
        $account->state = true;
        $account->employee_id = Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id;
        $account->save();

        $message = " CODE : ".$account->code;

        return back()->with("status", __("Account saved successfully") . " : ". $account->code);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        if(!$account){
            abort(404);
        }
        return view("adminTheme.Account.edit", [
            "account" => $account,
            "typeofaccounts" => TypeOfAccount::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $typeOfAccount = TypeOfAccount::all()->find($request->typeofaccount);

        if($typeOfAccount == null){
            $message = "Ce type de compte n'existe pas";
            return back()->with("error", __($message));
        }
        if($account->transactions->count() > 0){
            $message = "Sorry you cannot edit this account. Please contact an administrator";
            return back()->with("error", __($message));
        }else{

            $account->update([
                'code' => Account::genAccountsCode($typeOfAccount),
               'type_of_account_id' => $request->typeofaccount
            ]);

            $message = "The account has been modified";
            $status = "status";
        }

        return back()->with("status", __($message) . " : ". $account->code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {

        if($account->transactions->count() > 0){
            $message = "Sorry you cannot delete this account. Please contact an administrator";
            return back()->with("error", __($message));
        }else{

            $account->forceDelete();

            $message = "The account has been deleted";
            $status = "status";
        }


        return redirect()->route("admin.account.index")->with($status, __($message));
    }

    /**
     * @param Account $account
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showAccountHistory(Account $account){
        $result = DB::table("accounts")
            ->join("transactions", "accounts.id", "=", "transactions.account_id")
            ->select("accounts.*", "transactions.*")
            ->where("accounts.id", $account->id)->get();


        return view("adminTheme.Account.history", [
            "account" => $account,
            "transactions" => Transaction::all()
        ]);
    }
}
