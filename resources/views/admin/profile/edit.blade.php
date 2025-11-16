<x-admin-layout>
    <x-page-header
        title="My Profile"
        description="Manage your personal details, security settings, and account preferences."
        :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Profile']]"
    />

    <div class="max-w-5xl mx-auto mt-8 space-y-8">

        <!-- Profile Overview Card -->
        <div class="bg-white shadow-sm rounded-2xl p-8 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <!-- Profile Picture -->
                <div class="relative">
                    <img
                        src="{{ $admin->image ? asset('storage/' . $admin->image) : 'https://ui-avatars.com/api/?name=' . urlencode($admin->name) . '&background=6366F1&color=fff' }}"
                        alt="Profile Image"
                        class="w-28 h-28 rounded-full object-cover ring-4 ring-indigo-100 shadow"
                    >
                    <label class="absolute bottom-0 right-0 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-2 cursor-pointer transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 3.732z"/>
                        </svg>
                        <input type="file" name="image" accept="image/*" class="hidden" form="updateProfileForm">
                    </label>
                </div>

                <!-- Basic Info -->
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $admin->name }}</h2>
                    <p class="text-gray-500">{{ $admin->email }}</p>
                    <p class="text-sm mt-2 text-gray-400">
                        Member Code: <span class="font-mono text-gray-700">{{ $admin->member_code }}</span>
                    </p>
                    <p class="mt-2 text-sm {{ $admin->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                        Status: <span class="font-semibold capitalize">{{ $admin->status }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <form id="updateProfileForm" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Personal Info -->
            <div class="bg-white shadow-sm rounded-2xl p-8 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile</label>
                        <input type="text" name="mobile" value="{{ old('mobile', $admin->mobile) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 @error('mobile') border-red-500 @enderror">
                        @error('mobile')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Login</label>
                        <input type="text" value="{{ $admin->last_login ?? 'N/A' }}" readonly
                            class="w-full bg-gray-50 text-gray-500 border border-gray-200 rounded-lg px-4 py-2 cursor-not-allowed">
                    </div>

                </div>
            </div>

            <!-- Security Settings -->
            <div class="bg-white shadow-sm rounded-2xl p-8 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Security Settings</h3>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="font-medium text-gray-800">Two-Factor Authentication</p>
                        <p class="text-sm text-gray-500">
                            {{ $admin->google2fa_enabled ? '2FA is currently enabled on your account.' : 'Enable 2FA for extra account protection.' }}
                        </p>
                    </div>

                    @if ($admin->google2fa_enabled)
                        <a href="{{ route('admin.2fa.disable') }}"
                           class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition">
                            Disable
                        </a>
                    @else
                        <a href="{{ route('admin.2fa.enable') }}"
                           class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">
                            Enable
                        </a>
                    @endif
                </div>

                <!-- Inline Password Update Form -->
                <div class="mt-8">
                    <p class="font-medium text-gray-800 mb-1">Change Password</p>
                    <p class="text-sm text-gray-500 mb-4">Keep your account secure by using a strong, unique password.</p>

                    <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-4 max-w-md">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <input type="password" id="current_password" name="current_password"
                                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 @error('current_password') border-red-500 @enderror"
                                   required>
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" id="password" name="password"
                                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2 @error('password') border-red-500 @enderror"
                                   required>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2"
                                   required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</x-admin-layout>
