<x-admin-layout>
    <x-page-header
        title="Edit Client"
        description="Update client account details and contact preferences."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Clients', 'url' => route('admin.clients.index')],
            ['label' => 'Edit']
        ]"
    />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.clients.update', $client->id) }}"
            class="space-y-8"
        >
            @csrf
            @method('PUT')

            {{-- ================= BASIC INFO ================= --}}
            <h2 class="text-lg font-semibold border-b pb-2">Basic Info</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-input
                    label="Full Name"
                    name="name"
                    :value="old('name', $client->name)"
                    required
                    placeholder="John Doe"
                />

                <x-input
                    label="Email Address"
                    name="email"
                    type="email"
                    :value="old('email', $client->email)"
                    required
                    placeholder="example@email.com"
                />

                <x-input
                    label="Password (Leave blank to keep existing)"
                    name="password"
                    type="password"
                    placeholder="New Password (optional)"
                />

                <x-input
                    label="Phone Number"
                    name="phone"
                    :value="old('phone', $client->info->phone ?? '')"
                    required
                    placeholder="+8801XXXXXXXXX"
                />

                <x-input
                    label="Company Name"
                    name="company_name"
                    :value="old('company_name', $client->info->company_name ?? '')"
                    placeholder="ABC Ltd."
                />
            </div>

            {{-- ================= ADDRESS INFO ================= --}}
            <h2 class="text-lg font-semibold border-b pb-2 mt-10">Address Info</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-input
                    label="Address Line 1"
                    name="address1"
                    :value="old('address1', $client->info->address1 ?? '')"
                    placeholder="Street Address"
                />

                <x-input
                    label="Address Line 2"
                    name="address2"
                    :value="old('address2', $client->info->address2 ?? '')"
                    placeholder="Apartment, Suite, etc."
                />

                <x-input
                    label="City"
                    name="city"
                    :value="old('city', $client->info->city ?? '')"
                />

                <x-input
                    label="State / Region"
                    name="state_region"
                    :value="old('state_region', $client->info->state_region ?? '')"
                />

                <x-input
                    label="Postcode"
                    name="postcode"
                    :value="old('postcode', $client->info->postcode ?? '')"
                />

                <div class="mb-3">
                    <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Country
                    </label>

                    <select name="country_id" id="country_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ old('country_id', $userInfo->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- ================= OTHER INFO ================= --}}
            <h2 class="text-lg font-semibold border-b pb-2 mt-10">Other Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-input
                    label="Language"
                    name="language"
                    :value="old('language', $client->info->language ?? '')"
                    placeholder="English"
                />

                <x-input
                    label="Currency"
                    name="currency"
                    :value="old('currency', $client->info->currency ?? 'USD')"
                    placeholder="USD"
                />

                <x-input
                    label="Client Group"
                    name="client_group"
                    :value="old('client_group', $client->info->client_group ?? '')"
                    placeholder="Default"
                />

                <x-input
                    label="Payment Method"
                    name="payment_method"
                    :value="old('payment_method', $client->info->payment_method ?? '')"
                    placeholder="Bank Transfer / PayPal"
                />

                <x-input
                    label="Billing Contact"
                    name="billing_contact"
                    :value="old('billing_contact', $client->info->billing_contact ?? '')"
                    placeholder="Contact Person"
                />

                <x-input
                    label="Admin Notes"
                    name="admin_notes"
                    :value="old('admin_notes', $client->info->admin_notes ?? '')"
                    placeholder="Internal notes..."
                />

                <div class="flex items-center gap-3 pt-2">
                    <input
                        type="checkbox"
                        name="status"
                        value="Active"
                        class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500"
                        {{ old('status', $client->info->status ?? '') == 'Active' ? 'checked' : '' }}>
                    <label class="text-sm font-semibold text-gray-700">Active</label>
                </div>
            </div>

            {{-- ================= CHECKBOX SETTINGS ================= --}}
            <h2 class="text-lg font-semibold border-b pb-2 mt-10">Email & Notification Settings</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $checkboxes = [
                        'general_emails' => 'General Emails',
                        'invoice_emails' => 'Invoice Emails',
                        'support_emails' => 'Support Emails',
                        'product_emails' => 'Product Emails',
                        'domain_emails' => 'Domain Emails',
                        'affiliate_emails' => 'Affiliate Emails',
                        'late_fees' => 'Late Fees',
                        'separate_invoices' => 'Separate Invoices',
                        'status_update' => 'Status Updates',
                        'overdue_notices' => 'Overdue Notices',
                        'disable_cc_processing' => 'Disable Credit Card Processing',
                        'allow_single_sign_on' => 'Allow Single Sign-On',
                        'tax_exempt' => 'Tax Exempt',
                        'marketing_emails_optin' => 'Marketing Emails Opt-in',
                    ];
                @endphp

                @foreach ($checkboxes as $field => $label)
                    <div class="flex items-center gap-3">
                        <input
                            type="checkbox"
                            name="{{ $field }}"
                            value="1"
                            class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500"
                            {{ old($field, $client->info->$field ?? false) ? 'checked' : '' }}>
                        <label class="text-sm font-semibold text-gray-700">{{ $label }}</label>
                    </div>
                @endforeach
            </div>

            {{-- ================= SUBMIT ================= --}}
            <div class="pt-6">
                <button
                    type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition"
                >
                    Update Client
                </button>
            </div>
            <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
        </form>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
                // Initialize TomSelect
                const select = new TomSelect("#country_id", {
                    create: false,
                    sortField: { field: "text", direction: "asc" },
                    placeholder: "Search or select a country...",
                });

                // Preselect existing country (for edit form)
                const selectedCountry = "{{ old('country_id', $userInfo->country_id ?? '') }}";
                if (selectedCountry) {
                    select.setValue(selectedCountry);
                }
            });
        </script>

    </div>
</x-admin-layout>
