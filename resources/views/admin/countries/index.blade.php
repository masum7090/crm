<x-admin-layout>
    <x-page-header title="Countries" description="Search and manage countries."
        :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Countries']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">

            <x-input name="name" placeholder="Country Name" />

            <x-input name="shortcut" placeholder="Shortcut" />

            <x-input name="phone" placeholder="Phone Code" />

            <select name="status" class="border-gray-300 rounded-lg text-sm">
                <option value="">Any</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            <button class="bg-black text-white px-5 rounded-lg text-sm">Search</button>
        </form>

        <div class="flex justify-between items-center mb-3">
            {{-- <div class="text-gray-600 text-sm">
                {{ $countries->total() }} Records Found, Showing {{ $countries->firstItem() }} to {{ $countries->lastItem() }}
            </div> --}}

            <a href="{{ route('admin.countries.create') }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                + Add Country
            </a>
        </div>

        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="border-b text-gray-600">
                    <th class="py-3 px-2">ID</th>
                    <th class="py-3 px-2">Flag</th>
                    <th class="py-3 px-2">Name</th>
                    <th class="py-3 px-2">Shortcut</th>
                    <th class="py-3 px-2">Phone Code</th>
                    <th class="py-3 px-2">Currency</th>
                    <th class="py-3 px-2">Rate</th>
                    <th class="py-3 px-2">Status</th>
                    <th class="py-3 px-2 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="text-gray-800">
                @foreach ($countries as $country)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-2">{{ $country->id }}</td>

                        <td class="py-3 px-2">
                            <img src="{{ $country->icon }}" class="w-6 h-6 rounded shadow" />
                        </td>

                        <td class="py-3 px-2">{{ $country->name }}</td>
                        <td class="py-3 px-2">{{ $country->shortcut }}</td>
                        <td class="py-3 px-2">{{ $country->phone_number_code }}</td>
                        <td class="py-3 px-2">{{ $country->currency }}</td>
                        <td class="py-3 px-2">{{ $country->currency_rate }}</td>

                        <td class="py-3 px-2">
                            @if ($country->status)
                                <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">ACTIVE</span>
                            @else
                                <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">INACTIVE</span>
                            @endif
                        </td>

                        <td class="py-3 px-2 text-right">
                            <a href="{{ route('admin.countries.edit', $country->id) }}"
                                class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{-- {{ $countries->links() }} --}}
        </div>
    </div>
</x-admin-layout>
