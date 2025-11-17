<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DomainExtension;


class DomainExtensionController extends Controller
{
    /**

     * Show all domain extensions.
     */
    public function index(Request $request)
    {
        $query = DomainExtension::query();

        // Apply filters if provided
        if ($request->filled('extension')) {
            $query->where('extension', 'like', '%' . $request->extension . '%');
        }

        if ($request->filled('provider')) {
            $query->where('provider', 'like', '%' . $request->provider . '%');
        }

        if ($request->filled('register_price')) {
            $query->where('register_price', $request->register_price);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active' ? 1 : 0);
        }

        // Paginate
        $extensions = $query->orderBy('id', 'ASC')->paginate(20);

        return view('admin.domain_extensions.index', compact('extensions'));
    }

    /**
     * Show add form.
     */
    public function create()
    {
        return view('admin.domain_extensions.add', [

        ]);
    }

    /**
     * Store new extension.
     */
    public function store(Request $request)
    {
        $request->validate([
            'extension' => 'required|string|max:10|unique:domain_extensions,extension',
            'provider' => 'nullable|string|max:100',
            'register_price' => 'required|numeric|min:0',
            'renewal_price' => 'required|numeric|min:0',
            'transfer_price' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        DomainExtension::create([
            'extension' => $request->extension,
            'provider' => $request->provider, // Add this
            'register_price' => $request->register_price,
            'renewal_price' => $request->renewal_price,
            'transfer_price' => $request->transfer_price,
             'status'  => $request->has('status') ? 1 : 0,
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

        return view('admin.domain_extensions.edit', compact('extension'));
    }

    /**
     * Update domain extension.
     */
    public function update(Request $request, $id)
    {
        $extension = DomainExtension::findOrFail($id);
        $request->validate([
            'extension' => 'required|string|max:10|unique:domain_extensions,extension,' . $id,
            'provider' => 'required',
            'register_price' => 'required|numeric|min:0',
            'renewal_price' => 'required|numeric|min:0',
            'transfer_price' => 'required|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        $extension->update([
            'extension' => $request->extension,
            'provider' => $request->provider,
            'register_price' => $request->register_price,
            'renewal_price' => $request->renewal_price,
            'transfer_price' => $request->transfer_price,
            'status' => $request->status ? 1 : 0,
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
