<x-admin-layout>
    <x-page-header title="Create Hosting Plan" description="Add a new hosting package."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Hosting', 'url' => route('admin.hosting.index')], ['label' => 'Create']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6 max-w-4xl mx-auto">
        <form action="{{ route('admin.hosting.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Basic Info --}}
                <div class="col-span-2">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Plan Details</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plan Name</label>
                    <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. Basic Shared">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hosting Type</label>
                    <select name="hosting_type" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="shared">Shared Hosting</option>
                        <option value="vps">VPS Hosting</option>
                        <option value="dedicated">Dedicated Server</option>
                        <option value="reseller">Reseller Hosting</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provider</label>
                    <select name="provider_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Provider</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->name }} ({{ $provider->website }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                         <option value="">Select Category</option>
                         @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endforeach
                    </select>
                </div>
                
                <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                     <input type="number" name="price" step="0.01" min="0" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price ($)</label>
                     <input type="number" name="sale_price" step="0.01" min="0" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Specs --}}
                <div class="col-span-2 mt-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Technical Specs</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Disk Space</label>
                    <input type="text" name="space" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. 10 GB">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bandwidth</label>
                    <input type="text" name="bandwidth" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. Unlimited">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Allowed Domains</label>
                    <input type="text" name="domains" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. 1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Accounts</label>
                    <input type="text" name="emails" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. 5">
                </div>

                <div class="col-span-2 flex gap-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="ssl" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Free SSL Certificate</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="cpanel" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Include cPanel</span>
                    </label>
                     <label class="flex items-center">
                        <input type="checkbox" name="is_active" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Active</span>
                    </label>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.hosting.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Create Plan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
