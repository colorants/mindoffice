<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Adress;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','create','store','show','edit','update','destroy']);
    }

    public function index()
    {
//        $adress = Adress::with('Country')->get();
        $adress = Adress::all();


        return view('adresses.index', [
            'adresses' => $adress,
        ]);
    }



    public function create()
    {
            return view('adresses.create', [
                'adress' => new Adress(),
                'companies' => Company::all(),
                'countries' => Country::all(),


            ]);
        }

    public function store(Request $request)
    {
            $request->validate([
            ]);


            $adress = new Adress();
            $adress->type = $request->input('type');
            $adress->street = $request->input('street');
            $adress->housenumber = $request->input('housenumber');
            $adress->zipcode = $request->input('zipcode');
            $adress->city = $request->input('city');
            $adress->country_id = $request->input('country_id');
            $adress->company_id = $request->input('company_id');

            $adress->save();

            return redirect()->route('adresses.index')->with('success', 'Adress uploaded successfully!');
    }

    public function show(Adress $adress)
    {
        return view('adresses.show', [
            'adress' => $adress,


        ]);
    }

    public function edit(Adress $adress)
    {

    return view ('adresses.edit', [
        'adress' => $adress,
        'companies' => Company::all(),
        'countries' => Country::all(),
        ]);

    }

    public function update(Request $request, Adress $adress)
    {
        // Check if the authenticated user is the owner of the adress
        if (Auth::user()->id !== $adress->user_id) {
            return redirect()->route('adresses.index')->with('error', 'You do not have permission to update this adress.');
        }

        $request->validate([
            'type' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'housenumber' => 'required|integer',
            'zipcode' => 'required|string',
            'city' => 'required|string',
            'country_id' => 'required|exists:country_id',
            'company_id' => 'required|exists:company_id',
        ]);


        // Update other fields
        $adress->type = $request->input('type');
        $adress->street = $request->input('street');
        $adress->housenumber = $request->input('housenumber');
        $adress->zipcode = $request->input('zipcode');
        $adress->city = $request->input('city');
        $adress->country_id = $request->input('country_id');
        $adress->active = $request->has('active');
        $adress->save();

        // Redirect to adresses.index after successful update
        return redirect()->route('adresses.index')->with('success', 'Adress updated successfully!');
    }



    public function destroy(Adress $adress)
    {
        $adress->delete();
        return redirect()->route('adresses.index');
    }

}


