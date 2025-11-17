<x-admin-layout>
    <x-page-header title="Add Provider" description="Add new domain provider."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Providers']]" />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.providers.store') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <x-input label="Provider Name" name="name" :value="old('name')" placeholder="Namecheap" />
                <x-input label="Website" name="website" :value="old('website')" placeholder="https://namecheap.com" />
                <x-input label="API Key" name="api_key" :value="old('api_key')" placeholder="Optional" />

                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="status" value="active" class="h-5 w-5 rounded border-gray-300"
                        {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                    <label class="text-sm font-semibold text-gray-700">Active</label>
                </div>

            </div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Save Provider
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
