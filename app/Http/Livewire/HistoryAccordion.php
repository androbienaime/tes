<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Livewire\Component;

class HistoryAccordion extends Component
{

    public $account;

    public $search = "";

    public function render()
    {
        $i =0;
        $solde = 0;
        $transactions = $transactions =  $this->account->transactions;


        foreach($transactions as $t){
            if($t->type_of_transaction->name == "DEPOSIT"){
                $t->solde = $solde + $t->amount;
            }elseif($t->type_of_transaction->name == "WITHDRAWAL" || $t->type_of_transaction->name == "PAYMENT"){
                $t->solde = $solde - $t->amount;
            }

            $solde = $t->solde;
        }

        $transaction = $transactions->sortBy("created_at", SORT_DESC, true)->all();

        return view('livewire.history-accordion',[
            "history" => $transaction
        ]);
    }

    public function updatedQuery(){
        //
    }
}
