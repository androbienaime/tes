<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Customer;
use Livewire\Component;
use function PHPUnit\Framework\isEmpty;

class SearchAccountJob extends Component
{
    public $query ='';
    public $customer;
    public $classes = '';

    public function updatedQuery(){
        if(strlen($this->query) > 2) {
            $account = Account::where("code", $this->query)->get();
            if(count($account) > 0){
                $customer = Customer::where("id", $account[0]->customer_id)->get();
                $this->customer = $customer[0]->firstname . " " . $customer[0]->name;
                $this->classes = "text-green-600 border-green-400";
            }else{
                $this->customer = "";
                $this->classes = "border-red-600";
            }


        }

    }
    public function render()
    {
        return view('livewire.search-account-job');
    }
}
