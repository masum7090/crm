<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $query = Provider::query();

        // Filters (optional)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $providers = $query->latest()->paginate(10);

        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.providers.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'website' => 'nullable|url',
            'api_key' => 'nullable|string|max:255',
        ]);

        Provider::create([
            'name'    => $request->name,
            'website' => $request->website,
            'api_key' => $request->api_key,
            'status'  => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.providers.index')->with('success', 'Provider added successfully.');
    }

    public function edit($id)
    {
        $provider = Provider::findOrFail($id);
        return view('admin.providers.edit', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'website' => 'nullable|url',
            'api_key' => 'nullable|string|max:255',
        ]);

        $provider = Provider::findOrFail($id);
        $provider->update([
            'name'    => $request->name,
            'website' => $request->website,
            'api_key' => $request->api_key,
            'status'  => $request->has('status')
        ]);

        return redirect()->route('admin.providers.index')->with('success', 'Provider updated successfully.');
    }

    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();

        return redirect()->route('admin.providers.index')->with('success', 'Provider deleted successfully.');
    }
}
