<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\TypeOfTransaction;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $dateToday;
    protected $currentMonth;
    protected $deposit;
    protected $withdraw_payment;
    protected $columnChartModel;
    protected $pieChartModel = [];

    protected  $listeners = [
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function __construct()
    {
        $this->dateToday = Carbon::today()->toDateString();
        $this->currentMonth = date('m');
        $this->deposit = $deposit = DB::table("type_of_transactions")->where("name", "DEPOSIT")->first();
        $this->columnChartModel = $this->getStatColumnValue();
        $this->pieChartModel = $this->getStatPieColumnValue();

    }

    public function index(){

        $customer_count = Customer::all()->count();


        return view("adminTheme.dashboard",[
            "customer_count" => $customer_count,
            "sumDepositByDay" => $this->sumDepositByDay(),
            "sumDepositByMonth" => $this->sumDepositByMonth(),
            "sumWithdrawByDay" => $this->sumWhithdrawByDay(),
            "columnChartModel" => $this->columnChartModel,
            "pieChartModel" => $this->pieChartModel
        ]);
    }

    public function sumDepositByDay(){
        return DB::table("transactions")
            ->where("type_of_transaction_id", $this->deposit->id)
            ->whereDate('created_at', '=', $this->dateToday)
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

    protected function getStatColumnValue(){
        $transactions = Transaction::whereBetween('created_at', [now()->subYear(), now()])
            ->get();


        $transactionsByMonth = $transactions->groupBy(function($transaction) {
            return $transaction->created_at->format('Y-m');
        });

        $totalsByMonth = $transactionsByMonth->map(function($transactions) {
            return $transactions->sum('amount');
        });

//        $withdraw = Transaction::whereBetween('created_at', [now()->subYear(), now()])
//            ->where("type_of_transaction_id", $this->deposit->id)
//            ->get();
//        $withdrawByMonth = $withdraw->groupBy(function($withdraw) {
//            return $withdraw->created_at->format('Y-m');
//        });
//
//        $totalsWithdrawByMonth = $withdrawByMonth->map(function($withdraw) {
//            return $withdraw->sum('amount');
//        });

        $color = ["#0358ac", "#e6bd00", "#e65700", "#c27ba0", "#93c47d", "#8e7cc3",
            "#ffd966", "#FFCA3E", "#FF6F50", "#D03454", "#9C2162", "#772F67", "#0358ac"];
        $i=0;
        $columnChartModel = (new ColumnChartModel())
                ->setTitle('Total transaction')
                ->setOpacity(100)
                ->setAnimated(true)
                ->withOnColumnClickEventName('onColumnClick');

        foreach ($totalsByMonth as $key => $value){
            $da = new \DateTime($key);
            $columnChartModel->addColumn(
                $da->format('F'), $value, $color[$i]);

            $i++;
        }


        return $columnChartModel;
    }

    protected function getStatPieColumnValue(){
        $color = ["#0358ac", "#e6bd00", "#e65700", "#c27ba0", "#93c47d", "#8e7cc3",
                    "#ffd966", "#FFCA3E", "#FF6F50", "#D03454", "#9C2162", "#772F67", "#0358ac"];
        $account = Account::all();

        $type_account = $account->groupBy(function($account) {
            return $account->type_of_account;
        });

        $total = $type_account->map(function($account) {
            return $account->count('code');
        });

        $chartPie =  (new PieChartModel())
            ->setTitle("Nombre de compte enregistrer par type")
            ->setOpacity(100)
            ->setAnimated(true)
            ->withOnSliceClickEvent('onColumnClick');

        $i=0;
        foreach ($total as $key => $value){
            $chartPie->addSlice(json_decode($key)->name, $value, $color[$i]);
            $i++;
        }

        return $chartPie;

    }

}
