<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyInvoices extends Component
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
        $invoices = Invoice::where("company_id", "=", $this->company->id)->
        where("invoice_number", "like", "%" . $this->search . "%")->
        paginate(10, ["*"], "invoicesPage");
        return view('livewire.company-invoices', ["invoices" => $invoices]);
    }
}
