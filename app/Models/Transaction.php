<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Transaction extends Model
{
    const DEPOSIT = "DEPOSIT";
    const WITHDRAW = "WITHDRAWAL";
    const PAYEMENT = "PAYMENT";

    protected $fillable = [
        'account_id',
        'code',
        'amount',
        'employee_id',
        'type_of_transaction_id',
        'case_payments'
    ];
    use HasFactory, SoftDeletes;

    public function Employee(){
        return $this->belongsTo(Employee::class);
    }

    public function Type_of_transaction(){
        return $this->belongsTo(TypeOfTransaction::class);
    }

    public function Account(){
        return $this->belongsTo(Account::class);
    }


    public function tags_payment(){
        return $this->hasMany(TagsPayment::class);
    }

    public function tagspayment(){
        return $this->hasMany(TagsPayment::class);
    }
    public static function genTransactionCode(){
        $code = [
            'code' => mt_rand(1000000000, 999999999999)
        ];

        $rules = ['code' => 'unique:transactions'];

        $validate = Validator::make($code, $rules)->passes();

        return $validate ? $code['code'] : self::genTransactionCode();
    }

    public function scopeDepositsAndWithdrawalsByDay($query, $startDate, $endDate){
        $deposit = DB::table("type_of_transactions")->where("name", self::DEPOSIT)->first()->id;
        $withdrawal = DB::table("type_of_transactions")->where("name", self::WITHDRAW)->first()->id;
        $payment = DB::table("type_of_transactions")->where("name", self::PAYEMENT)->first()->id;

        return $query
            ->selectRaw("DATE(transactions.created_at) as transaction_date,
                SUM(CASE WHEN transactions.type_of_transaction_id = ". $deposit ." THEN amount ELSE 0 END) as deposit_sum,
                SUM(CASE WHEN transactions.type_of_transaction_id = ". $withdrawal ." THEN amount ELSE 0 END) as withdrawal_sum,
                SUM(CASE WHEN transactions.type_of_transaction_id = ". $payment ." THEN amount ELSE 0 END) as payment_sum")
            ->groupBy('transaction_date')
            ->orderBy("transaction_date", "DESC");

//        return $query->whereBetween('transactions.created_at', [$startDate, $endDate])
//            ->selectRaw("DATE(transactions.created_at) as transaction_date,
//                SUM(CASE WHEN transactions.type_of_transaction_id = ". $deposit ." THEN amount ELSE 0 END) as deposit_sum,
//                SUM(CASE WHEN transactions.type_of_transaction_id = ". $withdrawal ." THEN amount ELSE 0 END) as withdrawal_sum,
//                SUM(CASE WHEN transactions.type_of_transaction_id = ". $payment ." THEN amount ELSE 0 END) as payment_sum")
//            ->groupBy('transaction_date')
//            ->orderBy("transaction_date", "DESC");
    }
    public function scopeDepositsByDay($query, $startDate, $endDate)
    {
        return $query->join("type_of_transactions as tyt", "tyt.id", "=", "transactions.type_of_transaction_id")
            ->where('tyt.name', self::DEPOSIT)
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->selectRaw('DATE(transactions.created_at) as transaction_date, SUM(amount) as deposit_sum')
            ->groupBy('transaction_date');
    }

    public function scopeWithdrawalsByDay($query, $startDate, $endDate)
    {
        return $query->join("type_of_transactions as tyt", "tyt.id", "=", "transactions.type_of_transaction_id")
            ->where('tyt.name', self::WITHDRAW)
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->selectRaw('DATE(transactions.created_at) as transaction_date, SUM(amount) as withdrawal_sum')
            ->groupBy('transaction_date');
    }

    public static function ajouterTiret($liste) {
        $resultat = [];
        $n = count($liste);
        $i = 0;

        while ($i < $n) {
            $j = $i;
            while ($j < $n - 1 && $liste[$j] + 1 === $liste[$j + 1]) {
                $j++;
            }

            if ($i !== $j) {
                $resultat[] = $liste[$i] . '-' . $liste[$j];
            } else {
                $resultat[] = $liste[$i];
            }

            $i = $j + 1;
        }


        return implode(',', $resultat);
    }

    public static function formatDateToDmy($date) {
        $dateTime = new DateTime($date, new DateTimeZone('America/Port-au-Prince')); // Set the timezone to Haiti

        // Set the locale to French
        setlocale(LC_TIME, 'fr_FR');

        $formattedDate = strftime('%A %e %B %Y', $dateTime->getTimestamp());

        // Reset the locale to the default (optional)
        setlocale(LC_TIME, '');

        return $formattedDate;
    }
}
