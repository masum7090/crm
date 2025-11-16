<x-admin-layout>
    <div class="max-w-7xl mx-auto py-10">
    <h2 class="text-2xl font-semibold mb-6">Create New User</h2>

    <form action="{{ route('admin.clients.store') }}" method="POST" class="grid grid-cols-2 gap-6 bg-white p-8 rounded-2xl shadow">
        @csrf

        <!-- Left Column -->
        <div>
            <div class="mb-3">
                <label class="font-medium">First Name *</label>
                <input type="text" name="name" class="form-input w-full border rounded p-2" required>
            </div>
            <div class="mb-3">
                <label class="font-medium">Last Name</label>
                <input type="text" name="last_name" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="font-medium">Company Name</label>
                <input type="text" name="company_name" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="font-medium">Email Address *</label>
                <input type="email" name="email" class="form-input w-full border rounded p-2" required>
            </div>
            <div class="mb-3">
                <label class="font-medium">Password</label>
                <input type="password" name="password" class="form-input w-full border rounded p-2">
            </div>

            <div class="mt-6">
                <label class="font-medium">Language</label>
                <select name="language" class="form-select w-full border rounded p-2">
                    <option value="default">Default</option>
                </select>
            </div>

            <div class="mt-3">
                <label class="font-medium">Status</label>
                <select name="status" class="form-select w-full border rounded p-2">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="mt-3">
                <label class="font-medium">Client Group</label>
                <select name="client_group" class="form-select w-full border rounded p-2">
                    <option value="None">None</option>
                </select>
            </div>

            <!-- Email Notifications -->
            <div class="mt-6">
                <h3 class="font-semibold mb-2">Email Notifications</h3>
                @foreach(['general_emails'=>'General Emails','invoice_emails'=>'Invoice Emails','support_emails'=>'Support Emails','product_emails'=>'Product Emails','domain_emails'=>'Domain Emails','affiliate_emails'=>'Affiliate Emails'] as $key => $label)
                    <label class="block"><input type="checkbox" name="{{ $key }}" checked> {{ $label }}</label>
                @endforeach
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <div class="mb-3">
                <label class="font-medium">Address 1</label>
                <input type="text" name="address1" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="font-medium">Address 2</label>
                <input type="text" name="address2" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="font-medium">City</label>
                <input type="text" name="city" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="font-medium">State/Region</label>
                <input type="text" name="state_region" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label class="font-medium">Postcode</label>
                <input type="text" name="postcode" class="form-input w-full border rounded p-2">
            </div>
            <div class="mb-3">
                <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
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



            <div class="mb-3">
                <label class="font-medium">Phone Number *</label>
                <input type="text" name="phone" class="form-input w-full border rounded p-2" required>
            </div>

            <div class="grid grid-cols-2 gap-2 mt-6">
                <label><input type="checkbox" name="late_fees" checked> Late Fees</label>
                <label><input type="checkbox" name="separate_invoices" checked> Separate Invoices</label>
                <label><input type="checkbox" name="status_update" checked> Status Update</label>
                <label><input type="checkbox" name="overdue_notices" checked> Overdue Notices</label>
                <label><input type="checkbox" name="disable_cc_processing"> Disable CC Processing</label>
                <label><input type="checkbox" name="allow_single_sign_on" checked> Allow Single Sign-On</label>
                <label><input type="checkbox" name="tax_exempt"> Tax Exempt</label>
                <label><input type="checkbox" name="marketing_emails_optin"> Marketing Emails Opt-In</label>
            </div>

            <div class="mt-6">
                <label class="font-medium">Admin Notes</label>
                <textarea name="admin_notes" class="form-input w-full border rounded p-2"></textarea>
            </div>
        </div>

        <div class="col-span-2 text-right mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Save</button>
        </div>
        <!-- Tom Select CDN -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    </form>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#country_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "Search or select a country...",
            });
        });
    </script>
    <!-- Tom Select (Searchable Dropdown) -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>


</x-admin-layout>
