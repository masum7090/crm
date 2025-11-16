<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index()
    {
        $countries=Country::all();
        return view('admin.countries.index', compact('countries'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'shortcut'          => 'required|string|max:10',
            'icon'              => 'required|string|max:255',
            'phone_number_code' => 'required|string|max:10',
            'currency'          => 'nullable|string|max:50',
            'currency_rate'     => 'nullable|string|max:50',
        ]);

        Country::create([
            'name'              => $request->name,
            'shortcut'          => $request->shortcut,
            'icon'              => $request->icon,
            'phone_number_code' => $request->phone_number_code,
            'currency'          => $request->currency,
            'currency_rate'     => $request->currency_rate,
            'status'            => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Country Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'shortcut' => 'required|string|max:5',
            'icon' => 'nullable|string|max:255',
            'phone_number_code' => 'required|string|max:10',
            'currency' => 'required|string|max:10',
            'currency_rate' => 'required|numeric|min:0',
        ]);

        $validated['status'] = $request->has('status');

        $country = Country::findOrFail($id);
        $country->update($validated);

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }
}
