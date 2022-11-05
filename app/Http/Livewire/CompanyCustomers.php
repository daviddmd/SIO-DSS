<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyCustomers extends Component
{
    use WithPagination;

    public $company;
    public $search = '';

    public function mount($company)
    {
        $this->company = $company;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $filter = $this->search;
        $customers = Customer::where("company_id", "=", $this->company->id)->
        where(function ($query) use ($filter) {
            $query->where("tax_id", "=", $filter)->
            orWhere("name", "like", "%" . $filter . "%")->
            orWhere("phone", "like", "%" . $filter . "%")->
            orWhere("email", "like", "%" . $filter . "%");
        })->
        paginate(10, ["*"], "customersPage");
        return view('livewire.company-customers', ["customers" => $customers]);
    }
}
