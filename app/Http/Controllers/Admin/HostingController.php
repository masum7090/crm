<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HostingController extends Controller
{
    /**
     * Display a listing of hosting plans.
     */
    public function index()
    {
        // We assume hosting plans are in a category named 'Hosting' or similar,
        // OR we can filter by checking if 'meta->hosting_type' exists.
        // Let's rely on checking for 'hosting' related meta keys or a specific category if it exists.
        // For robustness, let's look for products that have 'is_hosting' in meta, or we can just fetch all products
        // and filter in the view, but that's inefficient.
        // Better: Let's assume we create a root category 'Hosting' automatically if not exists, 
        // or just rely on a convention.
        
        // For this implementation, I will filter products where `category` name contains 'Hosting' 
        // OR where meta has `hosting_type`.
        
        $hostingPlans = Product::whereHas('category', function ($q) {
            $q->where('name', 'like', '%Hosting%');
        })->orWhere('meta->is_hosting', true)->with('category')->latest()->paginate(10);
        
        return view('admin.hosting.index', compact('hostingPlans'));
    }

    /**
     * Show the form for creating a new hosting plan.
     */
    public function create()
    {
        $providers = Provider::where('status', 1)->get();
        // Get categories to let user organize plans (e.g. Shared, VPS)
        $categories = Category::all();
        
        return view('admin.hosting.create', compact('providers', 'categories'));
    }

    /**
     * Store a newly created hosting plan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id', // Make sure providers table exists or use meta
            
            // Hosting Specs
            'space' => 'required|string', // e.g. "10 GB"
            'bandwidth' => 'required|string', // e.g. "Unlimited"
            'domains' => 'required|string', // e.g. "1" or "Unlimited"
            'emails' => 'nullable|string',
            'hosting_type' => 'required|in:shared,vps,dedicated,reseller',
        ]);

        // Creating the product
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(4),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            
            // Store hosting specifics in meta
            'meta' => [
                'is_hosting' => true,
                'hosting_type' => $request->hosting_type,
                'provider_id' => $request->provider_id,
                'specs' => [
                    'space' => $request->space,
                    'bandwidth' => $request->bandwidth,
                    'domains' => $request->domains,
                    'emails' => $request->emails,
                    'ssl' => $request->has('ssl'),
                    'cpanel' => $request->has('cpanel'),
                ]
            ]
        ]);

        return redirect()->route('admin.hosting.index')->with('success', 'Hosting Plan created successfully.');
    }

    /**
     * Show the form for editing the specified hosting plan.
     */
    public function edit($id)
    {
        $plan = Product::findOrFail($id);
        $providers = Provider::where('status', 1)->get();
        $categories = Category::all();

        return view('admin.hosting.edit', compact('plan', 'providers', 'categories'));
    }

    /**
     * Update the specified hosting plan.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
            'space' => 'required|string',
            'bandwidth' => 'required|string',
            'hosting_type' => 'required|in:shared,vps,dedicated,reseller',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'meta' => [
                'is_hosting' => true,
                'hosting_type' => $request->hosting_type,
                'provider_id' => $request->provider_id,
                'specs' => [
                    'space' => $request->space,
                    'bandwidth' => $request->bandwidth,
                    'domains' => $request->domains,
                    'emails' => $request->emails,
                    'ssl' => $request->has('ssl'),
                    'cpanel' => $request->has('cpanel'),
                ]
            ]
        ]);

        return redirect()->route('admin.hosting.index')->with('success', 'Hosting Plan updated successfully.');
    }

    /**
     * Remove the specified hosting plan from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.hosting.index')->with('success', 'Hosting Plan deleted successfully.');
    }
}
