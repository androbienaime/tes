<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\TypeOfTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function index(){
        return view("adminTheme.Transaction.withdraw");
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|exists:accounts',
            'amount' => 'required|decimal:0,10|min:1',
        ]);


        $i=0;
        $message="";

        $account = Account::where("code", $request->code);



        if($request->amount > $account->first()->balance){
            $i++;
            $message = "The amount must be less than the amount in their account";
        }

        if($account->first()->balance <= 0 || $request->amount <= 0){
            $i++;
            $message = "The amount must be less than 0";
        }

        if(!$account->first()->state){
            $i++;
            $message = "This account has been deactivated";
        }

        if($account->first()->type_of_account->active_case_payments){
            $i++;
            $message = "You cannot withdraw from this type of account.";
        }

        if($i > 0){
            return back()->with("error", __($message));
        }

        DB::beginTransaction();

        try {
            $account->decrement("balance", $request->amount);


            Transaction::create([
                'amount' => $request->amount,
                'code' => Transaction::genTransactionCode(),
                'account_id' => Account::where("code", $request->code)->first()->id,
                'employee_id' => Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id,
                'type_of_transaction_id' => TypeOfTransaction::where("name", "WITHDRAWAL")->first()->id
            ]);


        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

        return back()->with("status", __("amount withdraw successfully"));
    }
}
