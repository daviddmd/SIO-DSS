<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyProducts extends Component
{
    use WithPagination;

    public $company;
    public $search = '';
    public $family = '';

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
        $families = Product::select("family")->distinct()->get("family");
        $filter = $this->search;
        $products = Product::where("company_id", "=", $this->company->id)->where(function ($query) use ($filter) {
            $query->where("description", "like", "%" . $filter . "%")->orWhere("code", "like", "%" . $filter . "%");
        });
        if (!empty($this->family)) {
            $products = $products->where("family", "=", $this->family);
        }
        return view('livewire.company-products', ["products" => $products->paginate(10, ["*"], "productsPage"), "families" => $families]);
    }
}
