<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Transaction;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $currentYear;

    protected $dateToday;
    protected $currentMonth;
    protected $deposit;
    protected $withdraw_payment;
    protected $columnChartModel;
    protected $pieChartModel = [];

    protected $query = [];
    protected $join = [];

    public function __contruct(){
        $this->currentYear = Carbon::now()->year;

        $this->dateToday = Carbon::today()->toDateString();
        $this->currentMonth = date('m');
        $this->deposit = DB::table("type_of_transactions")->where("name", "DEPOSIT")->first();
        $this->columnChartModel = $this->getStatColumnValue();
        $this->pieChartModel = $this->getStatPieColumnValue();

    }

    public function index(){
        return view("adminTheme.Report.index");
    }

    public function getmonthlyaverage(){
        $currentYear = Carbon::now()->year;
       $transactions = DB::table('transactions')
           ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total_amount'))
           ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', '>=', 1)
            ->whereMonth('created_at', '<=', 12)
           ->groupBy('month')
            ->get();

        return json_encode($transactions, true);
    }

    public function showDashEmployeeHistory(Employee $employee){
        if(!$employee){
            abort(404);
        }

        $this->join = ['employees', 'transactions.employee_id', '=', 'employees.id'];
        $this->query = ["employee_id", $employee->id];
        $this->__contruct();

        $customer_count = Customer::all()
            ->where("employee_id", '=', $employee->id)->count();

        return [
            "customer_count" => $customer_count,
            "sumDepositByDay" => $this->sumDepositByDay(),
            "sumDepositByMonth" => $this->sumDepositByMonth(),
            "sumWithdrawByDay" => $this->sumWhithdrawByDay(),
            "sumWithdrawByMonth" => $this->sumWhithdrawByMonth(),
            "sumReal" => $this->sumReal(),
        ];

    }

    public function showEmployeeHistory(Employee $employee){
        if(!$employee){
            abort(404);
        }

        $this->join = ['employees', 'transactions.employee_id', '=', 'employees.id'];
        $this->query = ["employee_id", $employee->id];
        $this->__contruct();

        $customer_count = Customer::all()
            ->where("employee_id", '=', $employee->id)->count();

        return view("adminTheme.Team.Employee.show-history",[
            "customer_count" => $customer_count,
            "sumDepositByDay" => $this->sumDepositByDay(),
            "sumDepositByMonth" => $this->sumDepositByMonth(),
            "sumWithdrawByDay" => $this->sumWhithdrawByDay(),
            "sumWithdrawByMonth" => $this->sumWhithdrawByMonth(),
            "sumReal" => $this->sumReal(),
            "columnChartModel" => $this->columnChartModel,
            "pieChartModel" => $this->pieChartModel,
            "employee" => $employee
        ]);
    }

    public function showBranchHistory(Branch $branch){
        if(!$branch){
            abort(404);
        }

        $this->join = ['employees', 'transactions.employee_id', '=', 'employees.id'];
        $this->query = ["employees.branch_id", $branch->id];
        $this->__contruct();

        $customer_count = DB::table("customers")
            ->select("employees.id")
            ->join("employees", "employees.id", "=", "customers.employee_id")
            ->where("employees.branch_id", '=', $branch->id)->get()->count();

        return view("adminTheme.Branch.show-history",[
            "customer_count" => $customer_count,
            "sumDepositByDay" => $this->sumDepositByDay(),
            "sumDepositByMonth" => $this->sumDepositByMonth(),
            "sumWithdrawByDay" => $this->sumWhithdrawByDay(),
            "sumWithdrawByMonth" => $this->sumWhithdrawByMonth(),
            "sumReal" => $this->sumReal(),
            "columnChartModel" => $this->columnChartModel,
            "pieChartModel" => $this->pieChartModel,
            "branch" => $branch
        ]);

    }

    public function sumDepositByDay(){
        return $sum =  DB::table("transactions")
            ->where("type_of_transaction_id", $this->deposit->id)
            ->join($this->join[0], $this->join[1], $this->join[2], $this->join[3])
            ->where($this->query[0], $this->query[1])
            ->where("transactions.deleted_at", '=', Null)
            ->whereDate('transactions.created_at', $this->dateToday)
            ->sum("amount");
    }

    public function sumDepositByMonth(){
        return DB::table("transactions")
            ->where("type_of_transaction_id", $this->deposit->id)
            ->join($this->join[0], $this->join[1], $this->join[2], $this->join[3])
            ->where($this->query[0], $this->query[1])
            ->where("transactions.deleted_at", '=', Null)
            ->whereMonth('transactions.created_at', '=', $this->currentMonth)
            ->sum("amount");
    }

    /**
     * @return int|mixed
     */
    public function sumWhithdrawByDay(){
        $withdraw =  DB::table("type_of_transactions")
            ->where("name", "WITHDRAWAL")
            ->first();

        $payment = DB::table("type_of_transactions")
            ->where("name", "PAYMENT")
            ->first();

        return DB::table("transactions")
            ->where("type_of_transaction_id", $withdraw->id)
            ->whereDate('transactions.created_at', '=', $this->dateToday)
            ->where($this->query[0], $this->query[1])
            ->orWhere("type_of_transaction_id", $payment->id)
            ->whereDate('transactions.created_at', '=', $this->dateToday)
            ->where($this->query[0], $this->query[1])
            ->join($this->join[0], $this->join[1], $this->join[2], $this->join[3])
            ->where("transactions.deleted_at", '=', Null)
            ->sum("amount");

    }

    public function sumWhithdrawByMonth(){
        $withdraw = DB::table("type_of_transactions")
            ->where("name", "WITHDRAWAL")
            ->first();

        $payment= DB::table("type_of_transactions")
            ->where("name", "PAYMENT")
            ->first();

        return DB::table("transactions")
            ->where("type_of_transaction_id", $withdraw->id)
            ->whereMonth('transactions.created_at', '=', $this->currentMonth)
            ->where($this->query[0], $this->query[1])
            ->orWhere("type_of_transaction_id", $payment->id)
            ->whereMonth('transactions.created_at', '=', $this->currentMonth)
            ->where($this->query[0], $this->query[1])
            ->join($this->join[0], $this->join[1], $this->join[2], $this->join[3])
            ->where("transactions.deleted_at", '=', Null)
            ->sum("amount");
    }

    public function sumReal(){
        return $this->sumDepositByDay() - $this->sumWhithdrawByDay();
    }

    protected function getStatColumnValue(){
        $transactions =
            Transaction::whereBetween('transactions.created_at', [now()->subYear(), now()])
                ->where("employee_id", $this->query[1])
                ->get();

        $transactionsByMonth = $transactions->groupBy(function($transaction) {
            return $transaction->created_at->format('Y-m');
        });

        $totalsByMonth = $transactionsByMonth->map(function($transactions) {
            return $transactions->sum('amount');
        });

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
        $account = Account::all()
            ->where("employee_id", $this->query[1]);

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
