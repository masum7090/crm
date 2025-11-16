<x-admin-layout>
    <x-page-header 
        :title="$extension ? 'Edit Domain Extension' : 'Add Domain Extension'" 
        description="Manage TLD extensions and pricing."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Domain Extensions', 'url' => route('admin.domain_extensions.index')],
            ['label' => $extension ? 'Edit' : 'Add']
        ]" 
    />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form 
            method="POST" 
            action="{{ $extension ? route('admin.domain_extensions.update', $extension->id) : route('admin.domain_extensions.store') }}" 
            class="space-y-8"
        >
            @csrf
            @if ($extension)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Extension --}}
                <x-input 
                    label="Extension (e.g. .com)" 
                    name="extension"
                    :value="old('extension', $extension->extension ?? '')"
                    placeholder=".com" 
                />

                {{-- Provider --}}
                <x-input 
                    label="Provider (Namecheap, ResellerClub, etc.)" 
                    name="provider"
                    :value="old('provider', $extension->provider ?? '')"
                    placeholder="Namecheap" 
                />

                {{-- Register Price --}}
                <x-input 
                    label="Register Price" 
                    name="register_price"
                    :value="old('register_price', $extension->register_price ?? '')"
                    placeholder="900.00" 
                />

                {{-- Renewal Price --}}
                <x-input 
                    label="Renewal Price" 
                    name="renewal_price"
                    :value="old('renewal_price', $extension->renewal_price ?? '')"
                    placeholder="950.00" 
                />

                {{-- Transfer Price --}}
                <x-input 
                    label="Transfer Price (Optional)" 
                    name="transfer_price"
                    :value="old('transfer_price', $extension->transfer_price ?? '')"
                    placeholder="900.00" 
                />

                {{-- Status --}}
                <div class="flex items-center gap-3 pt-2">
                    <input 
                        type="checkbox" 
                        name="status" 
                        value="active"
                        class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500"
                        {{ old('status', $extension->status ?? '') === 'active' ? 'checked' : '' }}
                    >
                    <label class="text-sm font-semibold text-gray-700">Active</label>
                </div>

            </div>

            <div class="pt-4">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    {{ $extension ? 'Update Extension' : 'Save Extension' }}
                </button>
            </div>
        </form>

    </div>
</x-admin-layout>
