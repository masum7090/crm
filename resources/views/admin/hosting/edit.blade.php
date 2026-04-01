<x-admin-layout>
    <x-page-header title="Edit Hosting Plan" description="Modify hosting package details."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Hosting', 'url' => route('admin.hosting.index')], ['label' => 'Edit']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6 max-w-4xl mx-auto">
        <form action="{{ route('admin.hosting.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Basic Info --}}
                <div class="col-span-2">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Plan Details</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plan Name</label>
                    <input type="text" name="name" value="{{ $plan->name }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hosting Type</label>
                    <select name="hosting_type" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="shared" {{ ($plan->meta['hosting_type'] ?? '') == 'shared' ? 'selected' : '' }}>Shared Hosting</option>
                        <option value="vps" {{ ($plan->meta['hosting_type'] ?? '') == 'vps' ? 'selected' : '' }}>VPS Hosting</option>
                        <option value="dedicated" {{ ($plan->meta['hosting_type'] ?? '') == 'dedicated' ? 'selected' : '' }}>Dedicated Server</option>
                         <option value="reseller" {{ ($plan->meta['hosting_type'] ?? '') == 'reseller' ? 'selected' : '' }}>Reseller Hosting</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provider</label>
                    <select name="provider_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Provider</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}" {{ ($plan->meta['provider_id'] ?? '') == $provider->id ? 'selected' : '' }}>
                                {{ $provider->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                         <option value="">Select Category</option>
                         @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $plan->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                         @endforeach
                    </select>
                </div>
                
                <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                     <input type="number" name="price" value="{{ $plan->price }}" step="0.01" min="0" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price ($)</label>
                     <input type="number" name="sale_price" value="{{ $plan->sale_price }}" step="0.01" min="0" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Specs --}}
                <div class="col-span-2 mt-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Technical Specs</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Disk Space</label>
                    <input type="text" name="space" value="{{ $plan->meta['specs']['space'] ?? '' }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bandwidth</label>
                    <input type="text" name="bandwidth" value="{{ $plan->meta['specs']['bandwidth'] ?? '' }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Allowed Domains</label>
                    <input type="text" name="domains" value="{{ $plan->meta['specs']['domains'] ?? '' }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Accounts</label>
                    <input type="text" name="emails" value="{{ $plan->meta['specs']['emails'] ?? '' }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="col-span-2 flex gap-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="ssl" {{ ($plan->meta['specs']['ssl'] ?? false) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Free SSL Certificate</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="cpanel" {{ ($plan->meta['specs']['cpanel'] ?? false) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Include cPanel</span>
                    </label>
                     <label class="flex items-center">
                        <input type="checkbox" name="is_active" {{ $plan->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Active</span>
                    </label>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $plan->description }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.hosting.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Update Plan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
