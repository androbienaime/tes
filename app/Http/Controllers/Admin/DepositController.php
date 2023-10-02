<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\TypeOfTransaction;
use Carbon\Carbon;
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

        // Recuperation de l'employee
        $employee_id = Employee::where('user_id', Auth::user()->getAuthIdentifier())->first()->id;

        $request->validate([
          'code' => 'required|exists:accounts',
            'amount' => 'required|decimal:0,10|min:1',
        ]);

        $numberTag = null;

        // Verifie quel type de compte pour appliquer les differentes regles.
        $account = Account::where("code", $request->code);
        if($account->first()->type_of_account->active_case_payments){
            $request->validate([
                'numberTag' => "required"
            ]);
        }else{
            // Empecher une meme employee d'enregistrer une transaction deux fois avec le meme montant durant un intervalle
            $currentTime = Carbon::now();
            $tenMinutesAgo = $currentTime->subMinutes(10);

            $count = DB::table('transactions')
                ->where('account_id', $account->first()->id)
                ->where('amount', $request->amount)
                ->where('employee_id', $employee_id)
                ->where('created_at', '>=', $tenMinutesAgo)
                ->count();

            if($count > 0) {
                return back()->with("errors2", __("Une entrée similaire existe déjà dans les 10 dernières minutes."));
            }
        }

        DB::beginTransaction();

            if(!$account->first()->state){
                return back()->with("errors2", __("Ce compte a ete desactiver"));
            }

            try {
                $account->increment("balance", $request->amount);


                $transaction = Transaction::create([
                    'amount' => $request->amount,
                    'code' => Transaction::genTransactionCode(),
                    'account_id' => Account::where("code", $request->code)->first()->id,
                    'employee_id' => $employee_id,
                    'type_of_transaction_id' => TypeOfTransaction::where("name", "DEPOSIT")->first()->id,
                ]);

                // si l'utilisateur a un livret qui fonnctionne par case
                if($account->first()->type_of_account->active_case_payments) {
                    $tags = array();
                    $tagsPut = [];
                    $somme = 0;
                    $i=0;
                    if($somme == 0){
                        $i++;
                    }
                    foreach ($request->numberTag as $nbt){
                        $arr = ["tags" => $nbt,
                            "transaction_id" => $transaction->id];

                            array_push($tags, $arr);
                            array_push($tagsPut, intval($nbt));

                            $somme += $nbt * $account->first()->type_of_account->price;
                        $i++;
                    }

                    if($request->amount < $somme){
                        return back()->with("errors2",
                            __("Erreur montant : " . $request->amount . " Gourdes est inferieur a la somme des differents tags : " . implode(', ', $request->numberTag)));
                    }
                    $tagsPay = $account->first()->tagspayment->pluck('tags')->toArray();


                    // Verifier si l'utilisateur n'a pas deja enregistrer ces tags
                    $intersection = array_intersect($tagsPay, $tagsPut);
                    if(!empty($intersection)){
                        return back()->with("errors2", __("Votre depot etait deja enregistrer"));
                    }

                    $account->first()->tagspayment()->createMany($tags);
                    $account->first()->save();
                }


            }catch (ValidationException $e){
                DB::rollBack();
                return back()->with("status", __("Error" + $e->getMessage()));
            }

            DB::commit();

        return back()->with("status", __("Amount deposit with successfully"));

    }
}
