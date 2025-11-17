<x-admin-layout>
    <x-page-header title="Providers" description="Manage domain service providers."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Providers']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <x-input name="name" placeholder="Provider Name" :value="request('name')" />

            <select name="status" class="border-gray-300 rounded-lg text-sm">
                <option value="">Any Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button class="bg-black text-white px-5 rounded-lg text-sm">Search</button>
        </form>

        <div class="flex justify-between items-center mb-3">
            <a href="{{ route('admin.providers.create') }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                + Add Provider
            </a>
        </div>

        <table class="w-full text-sm border-collapse">
            <thead>
            <tr class="border-b text-gray-600">
                <th class="py-3 px-2">ID</th>
                <th class="py-3 px-2">Name</th>
                <th class="py-3 px-2">Website</th>
                <th class="py-3 px-2">API Key</th>
                <th class="py-3 px-2">Status</th>
                <th class="py-3 px-2 text-right">Action</th>
            </tr>
            </thead>

            <tbody class="text-gray-800">
            @foreach ($providers as $provider)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-2">{{ $provider->id }}</td>
                    <td class="py-3 px-2">{{ $provider->name }}</td>
                    <td class="py-3 px-2"><a href="{{ $provider->website }}" target="_blank" class="text-blue-600">{{ $provider->website }}</a></td>
                    <td class="py-3 px-2">{{ Str::limit($provider->api_key, 15) }}</td>
{{--                    <td class="py-3 px-2">--}}
{{--                        @if ($provider->status == 'active')--}}
{{--                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">ACTIVE</span>--}}
{{--                        @else--}}
{{--                            <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">INACTIVE</span>--}}
{{--                        @endif--}}
{{--                    </td>--}}
                    <td class="py-3 px-2">
                        @if ($provider->status)
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">ACTIVE</span>
                        @else
                            <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">INACTIVE</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-right">
                        <a href="{{ route('admin.providers.edit', $provider->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form method="POST" action="{{ route('admin.providers.destroy', $provider->id) }}" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-6">{{ $providers->links() }}</div>

    </div>
</x-admin-layout>
