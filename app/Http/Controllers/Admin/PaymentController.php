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

class PaymentController extends Controller
{
    const TRANSACTION_METHOD = "PAYMENT";

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view("adminTheme.Transaction.payment");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $request->validate([
            'code' => 'required|exists:accounts',
        ]);


        $i=0;
        $message="";

        $account = Account::where("code", $request->code);


        if(!$account->first()->state){
            $i++;
            $message = "This account has been deactivated";
        }

        if($i > 0){
            return back()->with("error", __($message));
        }

        DB::beginTransaction();

        try {
            $amount = $account->first()->balance;

            $account->update([
               'balance' => 0,
               'state' => false
            ]);


            Transaction::create([
                'amount' => $amount,
                'code' => Transaction::genTransactionCode(),
                'account_id' => Account::where("code", $request->code)->first()->id,
                'employee_id' => Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id,
                'type_of_transaction_id' => TypeOfTransaction::where("name", self::TRANSACTION_METHOD)->first()->id
            ]);


        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

        return back()->with("status", __("Payment made successfully and the amount to be paid is")."  ".$amount);
    }
}
