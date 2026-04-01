<x-admin-layout>
    <x-page-header
        title="Domain Extensions"
        description="Search and manage domain extensions."
        :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Domain Extensions']]"
    />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">

        {{-- Search Form --}}
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">

            <x-input name="extension" placeholder=".com / .net / .xyz" />

            <select name="provider_id" class="border-gray-300 rounded-lg text-sm">
                <option value="">All Providers</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}"
                        {{ request('provider_id') == $provider->id ? 'selected' : '' }}>
                        {{ $provider->name }}
                    </option>
                @endforeach
            </select>

            <x-input name="register_price" placeholder="Register Price" />

            <select name="status" class="border-gray-300 rounded-lg text-sm">
                <option value="">Any Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button class="bg-black text-white px-5 rounded-lg text-sm">Search</button>
        </form>

        {{-- Add Button --}}
        <div class="flex justify-between items-center mb-3">
            <div class="flex gap-2">
                <a href="{{ route('admin.domain-extensions.fetch-from-provider') }}"
                   class="bg-green-600 text-white text-sm px-4 py-2 rounded-lg">
                    Sync TLDs
                </a>
            </div>
        </div>

        {{-- Table --}}
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="border-b text-gray-600">
                    <th class="py-3 px-2">ID</th>
                    <th class="py-3 px-2">Extension</th>
                    <th class="py-3 px-2">Register Price</th>
                    <th class="py-3 px-2">Renewal Price</th>
                    <th class="py-3 px-2">Transfer Price</th>
                    <th class="py-3 px-2">Provider</th>
                    <th class="py-3 px-2">Status</th>
                    <th class="py-3 px-2 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="text-gray-800">
                @foreach ($extensions as $ext)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-2">{{ $ext->id }}</td>

                        <td class="py-3 px-2 font-bold">{{ $ext->extension }}</td>

                        <td class="py-3 px-2">{{ number_format($ext->registration_price, 2) }}</td>
                        <td class="py-3 px-2">{{ number_format($ext->renewal_price, 2) }}</td>

                        <td class="py-3 px-2">
                            {{ $ext->transfer_price ? number_format($ext->transfer_price, 2) : 'N/A' }}
                        </td>

                        <td class="py-3 px-2">
                            {{ $ext->provider->name ?? 'N/A' }}
                        </td>
                        <td class="py-3 px-2">
                            @if ($ext->is_active)
                                <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">ACTIVE</span>
                            @else
                                <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">INACTIVE</span>
                            @endif
                        </td>

                        <td class="py-3 px-2 flex gap-2">
                            <form action="{{ route('admin.domain-extensions.destroy', $ext->id) }}" method="POST"
                                  onsubmit="return confirm('Remove this extension?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6">
            {{-- {{ $extensions->links() }} --}}
        </div>
    </div>
</x-admin-layout>
