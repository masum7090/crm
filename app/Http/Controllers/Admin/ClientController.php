<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('info')->orderBy('name', 'asc');


        // Optional filtering (e.g., by name, email, status, etc.)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('status')) {
            $query->whereHas('info', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $users = $query->paginate(10);

        return view('admin.clients.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries=Country::all();
        return view('admin.clients.add', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // User table validation
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',

            // User Info table validation
            'phone' => 'required|string|max:30',
            'company_name' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state_region' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'currency' => 'nullable|string|max:10',
        ]);

        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => !empty($validated['password'])
                    ? Hash::make($validated['password'])
                    : null,
            ]);

            // Prepare checkbox fields
            $checkboxes = [
                'general_emails',
                'invoice_emails',
                'support_emails',
                'product_emails',
                'domain_emails',
                'affiliate_emails',
                'late_fees',
                'separate_invoices',
                'status_update',
                'overdue_notices',
                'disable_cc_processing',
                'allow_single_sign_on',
                'tax_exempt',
                'marketing_emails_optin',
            ];

            $userInfoData = [
                'user_id' => $user->id,
                'phone' => $validated['phone'],
                'company_name' => $request->input('company_name'),
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
                'city' => $request->input('city'),
                'state_region' => $request->input('state_region'),
                'postcode' => $request->input('postcode'),
                'country_id' => $request->input('country_id'),
                'language' => $request->input('language'),
                'status' => $request->input('status', 'Active'),
                'client_group' => $request->input('client_group'),
                'payment_method' => $request->input('payment_method'),
                'billing_contact' => $request->input('billing_contact'),
                'currency' => $request->input('currency', 'USD'),
                'is_new_user' => $request->input('is_new_user', true),
                'admin_notes' => $request->input('admin_notes'),
            ];

            // Convert checkboxes
            foreach ($checkboxes as $field) {
                $userInfoData[$field] = $request->has($field);
            }

            // Create user_info record
            UserInfo::create($userInfoData);

            DB::commit();

            return redirect()->route('admin.clients.index')->with('success', 'User and user info created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $countries = Country::orderBy('name')->get();
        $client = User::with('info')->findOrFail($id);
        return view('admin.clients.edit', compact('client','countries'));
    }


    public function update(Request $request, $id)
    {
        $client = User::with('info')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $client->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'required|string|max:30',
        ]);

        DB::beginTransaction();

        try {
            // Update user
            $client->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password']
                    ? Hash::make($validated['password'])
                    : $client->password,
            ]);

            // Checkbox fields
            $checkboxes = [
                'general_emails', 'invoice_emails', 'support_emails', 'product_emails', 'domain_emails',
                'affiliate_emails', 'late_fees', 'separate_invoices', 'status_update', 'overdue_notices',
                'disable_cc_processing', 'allow_single_sign_on', 'tax_exempt', 'marketing_emails_optin',
            ];

            $data = $request->only([
                'phone', 'company_name', 'address1', 'address2', 'city', 'state_region',
                'postcode', 'country_id', 'language', 'status', 'client_group', 'payment_method',
                'billing_contact', 'currency', 'admin_notes'
            ]);

            foreach ($checkboxes as $field) {
                $data[$field] = $request->has($field);
            }

            $client->info()->update($data);

            DB::commit();

            return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->info()->delete();
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully!');
    }
}
