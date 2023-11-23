<?php

namespace App\Http\Livewire\Custom;

use App\Models\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesReportsTable extends Component
{
    use WithPagination;
    public $data = [];
    public $loading = false;

    public function render()
    {
        $this->loading = true;
        $cacheKey = 'employees_reports_' . now()->format('Ymd'); // Clé de cache globale

        // Si la page est la première, générer sans mise en cache
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            $depositsAndWithdrawals = Transaction::depositsAndWithdrawalsByDay($startDate, $endDate)
                ->orderBy('transaction_date', 'desc')
                ->paginate(7); // Ajustez le nombre d'éléments par page

            $this->loading = false;

            return view('livewire.custom.employees-reports-table', [
                'datas' => $depositsAndWithdrawals,
            ]);
    }

}
