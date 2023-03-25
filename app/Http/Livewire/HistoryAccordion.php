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

        return view('livewire.history-accordion',[
            "history" => $this->account->transactions
                ->sortBy("created_at", SORT_DESC, true)->all()
        ]);
    }

    public function updatedQuery(){
        //
    }
}
