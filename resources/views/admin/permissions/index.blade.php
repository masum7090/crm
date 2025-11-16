<x-admin-layout>
    <x-page-header title="Permissions" description="Manage available permissions." />

    <div class="bg-white p-6 rounded-lg shadow mt-6">
        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-800 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.permissions.store') }}" method="POST" class="flex gap-3 mb-6">
            @csrf
            <x-input name="name" placeholder="Enter Permission Name" />
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Add Permission</button>
        </form>

        <ul class="list-disc list-inside">
            @foreach($permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>
</x-admin-layout>
