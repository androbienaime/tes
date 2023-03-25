<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\TypeOfTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    const DEPOSIT = "DEPOSIT";
    const WITHDRAW = "WITHDRAW";
    const PAYEMENT = "PAYMENT";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        if(is_null($transaction->id)){
            abort(403);
        }
        return view("adminTheme.transaction.beforedestroy", [
            "transaction" => $transaction
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * @param Transaction $transaction
     */
    public function beforedestroy(Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction_name = $transaction->type_of_transaction->name;
        if($transaction_name == self::DEPOSIT){
            $this->DestroyDeposit($transaction);
            return redirect()->route('admin.deposit.index');
        }elseif ($transaction_name == self::WITHDRAW){
            $this->DestroyWithdraw($transaction);
            return redirect()->route('admin.withdraw.index');
        }elseif ($transaction_name == self::PAYEMENT){
            $this->DestroyPayment($transaction);
            return redirect()->route('admin.payment.index');
        }

    }

    public function DestroyDeposit(Transaction $transaction){

        DB::beginTransaction();

        try {
            $transaction->account->decrement("balance", $transaction->amount);

            $transaction->delete();

        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();

    }

    /**
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyWithdraw(Transaction $transaction){
        DB::beginTransaction();

            try {
                $transaction->account->increment("balance", $transaction->amount);

                $transaction->forceDelete();

            }catch (ValidationException $e){
                DB::rollBack();
                return back()->with("status", __("Error" + $e->getMessage()));
            }

        DB::commit();
    }

    public function DestroyPayment(Transaction $transaction){
        DB::beginTransaction();

        try {
            $transaction->account->increment("balance", $transaction->amount);
            $transaction->account->state = true;

            $transaction->forceDelete();

        }catch (ValidationException $e){
            DB::rollBack();
            return back()->with("status", __("Error" + $e->getMessage()));
        }

        DB::commit();
    }
}

