<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','create','store','show','edit','update','destroy','display_all']);
    }

    public function index()
    {
        $company = Company::all();


        return view('companies.index', [
            'companies' => $company,
        ]);
    }



    public function create()
    {
        return view('companies.create', [
            'company' => new Company(),
            'countries' => Country::all(),
        ]);
    }


    public function edit(company $company)
    {
        // Check if the authenticated user is the owner of the company
        return view('companies.edit', [
            'company' => $company,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        ]);

        $company = new Company();
        $company->name = $request->input('name');
        $company->kvk = $request->input('kvk');
        $company->btw = $request->input('btw');
        $company->country_id = $request->input('country_id');

        $company->save();

        return redirect()->route('companies.index')->with('success', 'company uploaded successfully!');
    }

    public function show(company $company)
    {
        $Company = Company::find($company->id);
        return view('companies.show', [
            'company' => $Company,


        ]);
    }


    public function update(Request $request, company $company)
    {
        // Check if the authenticated user is the owner of the company
        if (Auth::user()->id !== $company->user_id) {
            return redirect()->route('companies.index')->with('error', 'You do not have permission to update this company.');
        }

        $request->validate([
            'street' => 'required|string|max:255',
            'housenumber' => 'required|integer',
            'zipcode' => 'required|string',
            'city' => 'required|string',
            'country_id' => 'required|exists:country_id',
            'company_id' => 'required|exists:company_id',

        ]);


        // Update other fields
        $company->street = $request->input('street');
        $company->housenumber = $request->input('housenumber');
        $company->zipcode = $request->input('zipcode');
        $company->city = $request->input('city');
        $company->country_id = $request->input('country_id');
        $company->active = $request->has('active');
        $company->save();

        // Redirect to companies.index after successful update
        return redirect()->route('companies.index')->with('success', 'company updated successfully!');
    }



    public function destroy(company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }

}


