<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $currentYear;

    public function __contruct(){
      $this->currentYear = Carbon::now()->year;
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
}
