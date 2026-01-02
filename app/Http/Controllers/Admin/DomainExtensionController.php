<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomainExtension;
use App\Models\Provider;


class DomainExtensionController extends Controller
{
    /**

     * Show all domain extensions.
     */
    public function index(Request $request)
    {
        $query = DomainExtension::with('provider');

        if ($request->filled('extension')) {
            $query->where('extension', 'like', '%' . $request->extension . '%');
        }

        if ($request->filled('provider_id')) {
            $query->where('provider_id', $request->provider_id);
        }

        if ($request->filled('register_price')) {
            $query->where('registration_price', $request->register_price);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active' ? 1 : 0);
        }

        $extensions = $query->orderBy('id', 'ASC')->paginate(20);
        $providers = Provider::all();

        return view('admin.domain_extensions.index', compact('extensions', 'providers'));
    }


    /**
     * Show add form.
     */
    public function create()
    {
        $providers = Provider::all();
        return view('admin.domain_extensions.add', compact('providers'));
    }


    /**
     * Store new extension.
     */
    public function store(Request $request)
    {
        $request->validate([
            'extension' => 'required|string|max:10|unique:domain_extensions,extension',
            'provider_id' => 'nullable|exists:providers,id',
            'register_price' => 'required|numeric|min:0',
            'renewal_price' => 'required|numeric|min:0',
            'transfer_price' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        DomainExtension::create([
            'extension' => $request->extension,
            'provider_id' => $request->provider_id,
            'registration_price' => $request->register_price,
            'renewal_price' => $request->renewal_price,
            'transfer_price' => $request->transfer_price,
            'is_active' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.domain-extensions.index')
            ->with('success', 'Domain extension added successfully!');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $extension = DomainExtension::findOrFail($id);
        $providers = Provider::all();

        return view('admin.domain_extensions.edit', compact('extension', 'providers'));
    }

    /**
     * Update domain extension.
     */
    public function update(Request $request, $id)
    {
        $extension = DomainExtension::findOrFail($id);

        $request->validate([
            'extension' => 'required|string|max:10|unique:domain_extensions,extension,' . $id,
            'provider_id' => 'nullable|exists:providers,id',
            'register_price' => 'required|numeric|min:0',
            'renewal_price' => 'required|numeric|min:0',
            'transfer_price' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        $extension->update([
            'extension' => $request->extension,
            'provider_id' => $request->provider_id,
            'registration_price' => $request->register_price,
            'renewal_price' => $request->renewal_price,
            'transfer_price' => $request->transfer_price,
            'is_active' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.domain-extensions.index')
            ->with('success', 'Domain extension updated successfully!');
    }


    /**
     * Delete domain extension.
     */
    public function destroy($id)
    {
        DomainExtension::findOrFail($id)->delete();

        return redirect()
            ->route('admin.domain-extensions.index')
            ->with('success', 'Domain extension deleted successfully!');
    }
}
