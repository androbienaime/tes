<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Customer;
use Livewire\Component;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class SearchAccountJob extends Component
{
    public $query ='';
    public $customer;
    public $classes = '';
    public $error = " ";
    public $current_balance = 0;
    public $references_person = " ";
    public $classes_r = '';
    public $account = null;

    public function updatedQuery(){
        if(strlen($this->query) > 2) {
            $account = Account::where("code", $this->query)->first();

            if($account){
                $this->account = $account;
                $this->customer = $account->customer->firstname . " " . $account->customer->name;
                $this->current_balance = $account->balance;
                $this->classes = "text-green-600 border-green-400";
                $this->error = " ";

                $ref = $account->customer->Reference_people;
                if($ref->count() > 0){
                    $this->references_person = $ref[0]->full_name;
                    $this->classes_r = "text-green-600 border-green-400";
                }else {
                    $this->references_person = "Aucune personne";
                    $this->classes_r = "border-red-400 text-red-100";
                }

            }else{
                $this->customer = "";
                $this->classes = "border-red-400";
                $this->error = "Aucun client ne corespond a ce code";

            }
        }

    }
    public function render()
    {
        return view('livewire.search-account-job');
    }
}
