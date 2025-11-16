<x-admin-layout>
    <x-page-header title="Clients" description="Search and manage clients."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Clients']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">

        {{-- 🔍 Search Form --}}
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
            <x-input name="name" placeholder="Client Name" value="{{ request('name') }}" />
            <x-input name="email" placeholder="Email" value="{{ request('email') }}" />

            <select name="status" class="border-gray-300 rounded-lg text-sm">
                <option value="">Any Status</option>
                <option value="Active" @selected(request('status') === 'Active')>Active</option>
                <option value="Inactive" @selected(request('status') === 'Inactive')>Inactive</option>
            </select>

            <button class="bg-black text-white px-5 rounded-lg text-sm">Search</button>
        </form>

        {{-- ➕ Add New Client --}}
        <div class="flex justify-between items-center mb-3">
            <div class="text-gray-600 text-sm">
                {{ $users->total() }} Records Found,
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }}
            </div>

            <a href="{{ route('admin.clients.create') }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                + Add Client
            </a>
        </div>

        {{-- 🧾 Table --}}
        <table class="w-full text-sm border-collapse">
            <thead>
            <tr class="border-b text-gray-600">
                <th class="py-3 px-2">ID</th>
                <th class="py-3 px-2">Name</th>
                <th class="py-3 px-2">Email</th>
                <th class="py-3 px-2">Phone</th>
                <th class="py-3 px-2">Company</th>
                <th class="py-3 px-2">Country</th>
                <th class="py-3 px-2">Status</th>
                <th class="py-3 px-2">Currency</th>
                <th class="py-3 px-2 text-right">Action</th>
            </tr>
            </thead>

            <tbody class="text-gray-800">
            @forelse ($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-2">{{ $user->id }}</td>
                    <td class="py-3 px-2">{{ $user->name }}</td>
                    <td class="py-3 px-2">{{ $user->email }}</td>
                    <td class="py-3 px-2">{{ $user->info->phone ?? '—' }}</td>
                    <td class="py-3 px-2">{{ $user->info->company_name ?? '—' }}</td>
                    <td class="py-3 px-2">{{ $user->info->country->name ?? '—' }}</td>

                    <td class="py-3 px-2">
                        @if (optional($user->info)->status === 'Active')
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">ACTIVE</span>
                        @else
                            <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">INACTIVE</span>
                        @endif
                    </td>

                    <td class="py-3 px-2">{{ $user->info->currency ?? 'USD' }}</td>

                    <td class="py-3 px-2 text-right">
                        <a href="{{ route('admin.clients.edit', $user->id) }}"
                           class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-gray-500 py-4">
                        No clients found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- 📄 Pagination --}}
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
