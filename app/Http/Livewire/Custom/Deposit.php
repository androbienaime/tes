<?php

namespace App\Http\Livewire\Custom;

use App\Models\Account;
use App\Models\Customer;
use Livewire\Component;
use Livewire\Livewire;

class Deposit extends Component
{
    public $query = "";
    public Account $account;
    public $fullname = "";
    public $current_balance=0;
    public $classes;
    public $amount;
    public $tagspayment;
    public $echelon;
    public $duration;

    public $account_state = true;

    public bool $accountExist = false;

    protected $listeners = ['tagspayment' => 'postTag'];


    public function render()
    {
        return view('livewire.custom.deposit');
    }

    public function updatedQuery()
    {
        if (strlen($this->query) > 2) {
            $account = Account::where("code", $this->query)->first();
            if($account){

                $this->fullname = $account->customer->firstname . " " . $account->customer->name;
                $this->current_balance = $account->balance;
                $this->classes = "text-green-600 border-green-400";
                $this->error = " ";

                $this->account = $account;
                $this->accountExist = true;
                $this->account_state = $account->state;

                $this->tagspayment = json_encode($account->tagspayment);
                $this->echelon = json_encode($account->type_of_account->price);
                $this->duration = json_encode($account->type_of_account->duration);

            }else{
                $this->fullname = "";
                $this->current_balance =0;
                $this->classes = "border-red-400";
                $this->error = "Aucun client ne corespond a ce code";
                $this->accountExist = false;
            }
        }elseif ($query = " "){
            $this->current_balance =0;
            $this->fullname = "";
            $this->accountExist = false;
        }
    }

    public function postTag($parameter){
        dd($this->emit('tagspayment', 1233));
    }
}
