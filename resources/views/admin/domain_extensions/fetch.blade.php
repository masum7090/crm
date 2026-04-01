<x-admin-layout>
    <x-page-header
        title="Sync TLDs from Provider"
        description="Review and synchronize Top-Level Domains (TLDs) from ResellBiz."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Domain Extensions', 'url' => route('admin.domain-extensions.index')],
            ['label' => 'Sync']
        ]"
    />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
        <form method="POST" action="{{ route('admin.domain-extensions.store-fetched') }}">
            @csrf

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Available TLDs from Provider</h3>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                    Sync Selected TLDs
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="py-3 px-4 w-10">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300">
                            </th>
                            <th class="py-3 px-4">Extension</th>
                            <th class="py-3 px-4 text-right">Register Cost</th>
                            <th class="py-3 px-4 text-right">Renew Cost</th>
                            <th class="py-3 px-4 text-right">Transfer Cost</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tlds as $index => $tld)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4">
                                <input type="checkbox" name="tlds[{{ $index }}][selected]" value="1" class="tld-checkbox rounded border-gray-300">
                                <input type="hidden" name="tlds[{{ $index }}][extension]" value="{{ $tld['extension'] }}">
                                <input type="hidden" name="tlds[{{ $index }}][register_price]" value="{{ $tld['register_price'] }}">
                                <input type="hidden" name="tlds[{{ $index }}][renewal_price]" value="{{ $tld['renewal_price'] }}">
                                <input type="hidden" name="tlds[{{ $index }}][transfer_price]" value="{{ $tld['transfer_price'] }}">
                            </td>
                            <td class="py-3 px-4 font-bold">.{{ $tld['extension'] }}</td>
                            <td class="py-3 px-4 text-right text-green-600 font-medium">${{ number_format($tld['register_price'], 2) }}</td>
                            <td class="py-3 px-4 text-right text-blue-600 font-medium">${{ number_format($tld['renewal_price'], 2) }}</td>
                            <td class="py-3 px-4 text-right text-gray-600 font-medium">${{ number_format($tld['transfer_price'], 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p>No TLDs found or API connection failed.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(count($tlds) > 0)
            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 shadow-md transform hover:-translate-y-0.5 transition-all">
                    Sync Selected TLDs
                </button>
            </div>
            @endif
        </form>
    </div>

    @push('scripts')
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.tld-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
    @endpush
</x-admin-layout>
