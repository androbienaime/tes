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

class DepositController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view("adminTheme.Transaction.deposit");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){

        $request->validate([
          'code' => 'required|exists:accounts',
            'amount' => 'required|decimal:0,10|min:1',
        ]);

        $numberTag = null;

        $account = Account::where("code", $request->code);
        if($account->first()->type_of_account->active_case_payments){
            $request->validate([
                'numberTag' => "required"
            ]);

           $numberTag = implode(',', $request->numberTag);
        }

        DB::beginTransaction();

            if(!$account->first()->state){
                return back()->with("errors2", __("Ce compte a ete desactiver"));
            }

            try {
                $account->increment("balance", $request->amount);


                Transaction::create([
                    'amount' => $request->amount,
                    'code' => Transaction::genTransactionCode(),
                    'account_id' => Account::where("code", $request->code)->first()->id,
                    'employee_id' => Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id,
                    'type_of_transaction_id' => TypeOfTransaction::where("name", "DEPOSIT")->first()->id,
                    'case_payments' => $numberTag
                ]);


            }catch (ValidationException $e){
                DB::rollBack();
                return back()->with("status", __("Error" + $e->getMessage()));
            }

            DB::commit();

        return back()->with("status", __("Amount deposit with successfully"));

    }
}
