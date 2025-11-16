<x-admin-layout>
    <x-page-header title="Enable Two-Factor Authentication"
        description="Secure your account by adding an extra layer of protection." :breadcrumbs="[
            ['label' => 'Home', 'url' => route('admin.dashboard')],
            ['label' => 'Security'],
            ['label' => 'Enable 2FA'],
        ]" />

    <div class="max-w-lg mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Enable Two-Factor Authentication</h2>
            <p class="text-gray-500 text-sm mt-2">
                Scan the QR code below using your Google Authenticator app.
            </p>
        </div>


        <div class="flex justify-center mb-6">
            <div class="p-3 bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="w-44 h-44 flex items-center justify-center">
                    {!! $qrCodeImageUrl !!}
                </div>
            </div>
        </div>

        <div class="text-center text-sm text-gray-600 mb-6">
            <p>Or manually enter this key:</p>
            <p class="mt-1 font-mono text-lg font-semibold text-indigo-600">{{ $secret }}</p>
        </div>

        <form method="POST" action="{{ route('admin.2fa.confirm') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Enter the 6-digit code from your app
                </label>
                <input name="one_time_password" type="text" maxlength="6"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-center tracking-widest text-lg font-mono @error('one_time_password') border-red-500 @enderror"
                    required>
                @error('one_time_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition">
                Verify & Enable
            </button>
        </form>

        <div class="mt-8">
            <h3 class="text-sm font-semibold text-gray-800">Recovery Codes</h3>
            <p class="text-xs text-gray-500 mt-1">
                Save these codes in a secure place. Each code can be used once if you lose access to your authenticator
                app.
            </p>

            <ul class="text-sm bg-gray-50 border border-gray-200 rounded-lg p-3 mt-3 space-y-1 font-mono text-gray-700">
                @foreach ($recoveryCodes as $code)
                    <li>{{ $code }}</li>
                @endforeach
            </ul>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('admin.profile.edit') }}"
                class="inline-block text-sm text-gray-600 hover:text-indigo-600 font-medium transition">
                ← Back to Profile
            </a>
        </div>
    </div>
</x-admin-layout>
