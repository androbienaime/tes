<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class SearchCustomer extends Component
{
    public string $filter = "";
    public $customers = [];

    public function updatedFilter(){
        $this->customers = [];

        if(strlen($this->filter) > 2) {
            $req = '%' . $this->filter . '%';
            $customers = Customer::where("name", 'like', $req)
                ->orWhere("firstname", "like", $req)->get();

            if (count($customers) > 0) {
                $this->customers = $customers;

            }else{
                $this->customers = [];
            }
        }

    }
    public function render()
    {
        return view('livewire.search-customer');
    }
}
