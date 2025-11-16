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
    public function index()
    {


        $extensions = DomainExtension::orderBy('id', 'DESC')->paginate(20);
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
            'registration_price' => 'required|numeric|min:0',
            'renew_price' => 'required|numeric|min:0',
            'transfer_price' => 'required|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        DomainExtension::create([
            'extension' => $request->extension,
            'registration_price' => $request->registration_price,
            'renew_price' => $request->renew_price,
            'transfer_price' => $request->transfer_price,
            'status' => $request->status ? 1 : 0,
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

        return view('admin.domain_extensions.form', compact('extension'));
    }

    /**
     * Update domain extension.
     */
    public function update(Request $request, $id)
    {
        $extension = DomainExtension::findOrFail($id);

        $request->validate([
            'extension' => 'required|string|max:10|unique:domain_extensions,extension,' . $id,
            'registration_price' => 'required|numeric|min:0',
            'renew_price' => 'required|numeric|min:0',
            'transfer_price' => 'required|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        $extension->update([
            'extension' => $request->extension,
            'registration_price' => $request->registration_price,
            'renew_price' => $request->renew_price,
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
