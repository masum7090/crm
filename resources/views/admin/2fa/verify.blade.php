<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify 2FA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-indigo-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-6">
            <div class="w-14 h-14 mx-auto mb-3 flex items-center justify-center bg-indigo-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11zM12 14v.01M12 6a9 9 0 100 12 9 9 0 000-12z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Two-Factor Authentication</h2>
            <p class="text-gray-500 text-sm mt-1">Enter the 6-digit code from your Authenticator app</p>
        </div>

        <form method="POST" action="{{ route('admin.2fa.verify.post') }}" class="space-y-5">
            @csrf

            <div>
                <input name="one_time_password" type="text" placeholder="123456" maxlength="6" required autofocus
                    class="w-full text-center tracking-widest text-lg font-mono border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-lg py-3 px-4 outline-none transition duration-150 ease-in-out @error('one_time_password') border-red-500 @enderror">
                @error('one_time_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                Verify & Continue
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Lost your device?
                <a href="#" class="text-indigo-600 font-medium hover:underline">Use a recovery code instead</a>.
            </p>

            <form method="POST" action="{{ route('admin.logout') }}" class="mt-4 inline">
                @csrf
                <button type="submit"
                    class="text-sm text-red-600 font-medium hover:underline focus:outline-none transition">
                    Logout
                </button>
            </form>
        </div>

    </div>

</body>

</html>
