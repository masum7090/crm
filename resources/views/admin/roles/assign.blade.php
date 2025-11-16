<x-admin-layout>
    <x-page-header title="Assign Role to User" description="Assign or change user roles." />

    <div class="bg-white p-6 rounded-lg shadow mt-6">
        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-800 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.role.assign.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold mb-2">Select User</label>
                <select name="user_id" class="w-full border-gray-300 rounded-lg">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-2">Select Role</label>
                <select name="role" class="w-full border-gray-300 rounded-lg">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="bg-red-600 text-white px-6 py-2 rounded-lg">Assign Role</button>
        </form>
    </div>
</x-admin-layout>
