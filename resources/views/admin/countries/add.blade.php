<x-admin-layout>
    <x-page-header title="Countries" description="Manage countries, flags, phone codes and currency."
        :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Countries']]" />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.countries.store') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <x-input label="Country Name" name="name" :value="old('name')" placeholder="Bangladesh" />

                <x-input label="Shortcut" name="shortcut" :value="old('shortcut')" placeholder="BD" />

                <x-input label="Flag Icon (URL or Path)" name="icon" :value="old('icon')" placeholder="/flags/bd.png" />

                <x-input label="Phone Number Code" name="phone_number_code" :value="old('phone_number_code')" placeholder="+880" />

                <x-input label="Currency" name="currency" :value="old('currency')" placeholder="BDT" />

                <x-input label="Currency Rate (Based on BDT)" name="currency_rate" :value="old('currency_rate')" placeholder="1.00" />

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
                    Save Country
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
