<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\TypeOfTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $dateToday;
    protected $currentMonth;
    protected $deposit;
    protected $withdraw_payment;

    public function __construct()
    {
        $this->dateToday = Carbon::today()->toDateString();
        $this->currentMonth = date('m');
        $this->deposit = $deposit = DB::table("type_of_transactions")->where("name", "DEPOSIT")->first();
    }

    public function index(){

        $customer_count = Customer::all()->count();


        return view("adminTheme.dashboard",[
            "customer_count" => $customer_count,
            "sumDepositByDay" => $this->sumDepositByDay(),
            "sumDepositByMonth" => $this->sumDepositByMonth(),
            "sumWithdrawByDay" => $this->sumWhithdrawByDay()
        ]);
    }

    public function sumDepositByDay(){
        return DB::table("transactions")
            ->where("type_of_transaction_id", $this->deposit->id)
            ->whereDate('created_at', $this->dateToday)
            ->sum("amount");
    }

    public function sumDepositByMonth(){
        return DB::table("transactions")
            ->where("type_of_transaction_id", $this->deposit->id)
            ->whereMonth('created_at', '=', $this->currentMonth)
            ->sum("amount");
    }

    public function sumWhithdrawByDay(){
        $withdraw = $deposit = DB::table("type_of_transactions")
            ->where("name", "WITHDRAW")
            ->orWhere("name", "PAYMENT")
            ->first();

        return DB::table("transactions")
            ->where("type_of_transaction_id", $withdraw->id)
            ->whereDate('created_at', $this->dateToday)
            ->sum("amount");
    }

}
