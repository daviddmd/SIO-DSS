<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $filter = $request->input("filter", "");
        if (!empty($filter)) {
            $companies = Company::where("name", "like", "%" . $filter . "%")->
            orWhere("tax_registration_number", "=", $filter)->paginate(5)->withQueryString();
        }
        else {
            $companies = Company::paginate(5)->withQueryString();
        }
        return view("companies.index", ["companies" => $companies, "filter" => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        return redirect()->route("companies.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        return redirect()->route("companies.index");
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|View
     */
    public function show(Company $company)
    {
        return view("companies.show", ["company" => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function edit(Company $company)
    {
        return redirect()->route("companies.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return redirect()->route("companies.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route("companies.index");
    }
}
