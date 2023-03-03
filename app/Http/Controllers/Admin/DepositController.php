<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function index(){
        return view("adminTheme.Deposit.deposit");
    }

    public function store(Request $request){
        $request->validate([
          'code' => 'required|exists:accounts',
            'amount' => 'required|decimal:0,10|min:1'
        ]);


        DB::beginTransaction();

        $account = Account::where("code", $request->code)->update([
                'balance' => Account::where("code", $request->code)->get()[0]->balance + $request->amount
            ]);



        Transaction::create([
            'amount' => $request->amount,
            'account_id' => Account::where("code", $request->code)->get()[0]->id,
            'employee_id' => Employee::where('user_id', Auth::user()->getAuthIdentifier())->get()[0]->id,
            'type_of_transaction_id' => 1
        ]);

        DB::commit();

        return back()->with("status", __("Amount deposit with successfully"));

    }
}
