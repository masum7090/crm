<x-admin-layout>
    <x-page-header title="Roles & Permissions" description="Manage application roles and permissions." />

    <div class="bg-white p-6 rounded-lg shadow mt-6">
        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-800 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.roles.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="flex items-center gap-4">
                <x-input name="name" placeholder="Enter Role Name" />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Role</button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($roles as $role)
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $role->name }}</h3>
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="space-y-1 mb-3">
                            @foreach($permissions as $permission)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                    <span>{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Update</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>
