<x-admin-layout>
    <x-page-header
        title="Domain Extensions"
        description="Add new domain extension with pricing and provider."
        :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Domain Extensions']]"
    />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.domain-extensions.store') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Extension --}}
                <x-input
                    label="Extension (e.g. .com)"
                    name="extension"
                    :value="old('extension')"
                    placeholder=".com"
                />

                {{-- Provider --}}
                <x-input
                    label="Provider (Namecheap, ResellerClub, etc.)"
                    name="provider"
                    :value="old('provider')"
                    placeholder="Namecheap"
                />

                {{-- Register Price --}}
                <x-input
                    label="Register Price"
                    name="register_price"
                    :value="old('register_price')"
                    placeholder="900.00"
                />

                {{-- Renewal Price --}}
                <x-input
                    label="Renewal Price"
                    name="renewal_price"
                    :value="old('renewal_price')"
                    placeholder="950.00"
                />

                {{-- Transfer Price --}}
                <x-input
                    label="Transfer Price (Optional)"
                    name="transfer_price"
                    :value="old('transfer_price')"
                    placeholder="900.00"
                />

                {{-- Status Checkbox --}}
                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="status" value="1"
                           class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500"
                        {{ old('status') ? 'checked' : '' }}>
                    <label class="text-sm font-semibold text-gray-700">Active</label>
                </div>

            </div>

            <div class="pt-4">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Save Extension
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
