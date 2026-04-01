<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#0ea5e9',
                        accent: '#8b5cf6',
                    },
                    animation: {
                        fadeIn: 'fadeIn 0.6s ease-out',
                        float: 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(10px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' }
                        },
                        float: {
                            '0%,100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                    }
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 text-slate-800 flex items-center justify-center overflow-hidden relative">

    <!-- Background shapes (Subtle for light theme) -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-primary/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/3 right-1/3 w-72 h-72 bg-accent/10 rounded-full blur-3xl animate-float [animation-delay:2s]"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md p-8 rounded-2xl bg-white border border-gray-100 shadow-2xl animate-fadeIn mr-4 ml-4">
        <div class="px-6 pt-2 pb-6 text-center">
            <div class="flex items-center justify-center gap-2 mb-4">
                <img src="{{ asset('picon.png') }}" alt="Project Icon" class="h-12 w-12 rounded-xl shadow-md">
            </div>
            <h1 class="font-bold text-2xl text-gray-900 tracking-tight">Admin Portal</h1>
            <p class="text-sm text-gray-500 mt-1">Please sign in to your account</p>
        </div>

        <!-- Laravel login form -->
        <form id="adminLogin" method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4" novalidate>
            @csrf

            <!-- Email -->
            <div class="relative group">
                <input id="adminEmail" name="email" type="email" value="{{ old('email') }}" required placeholder=" "
                       class="peer w-full rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-transparent px-4 pt-6 pb-2 outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" />
                <label for="adminEmail"
                       class="absolute left-4 top-2 text-xs font-semibold text-gray-500 transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:font-normal peer-focus:top-2 peer-focus:text-xs peer-focus:font-semibold peer-focus:text-primary">
                    Admin Email
                </label>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative group">
                <input id="adminPassword" name="password" type="password" required placeholder=" "
                       class="peer w-full rounded-xl bg-gray-50 border border-gray-200 text-gray-900 placeholder-transparent px-4 pt-6 pb-2 pr-10 outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" />
                <label for="adminPassword"
                       class="absolute left-4 top-2 text-xs font-semibold text-gray-500 transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:font-normal peer-focus:top-2 peer-focus:text-xs peer-focus:font-semibold peer-focus:text-primary">
                    Password
                </label>
                <button type="button" id="togglePass"
                        class="absolute right-3 top-[calc(50%+4px)] -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">👁️</button>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me + Forgot -->
            <div class="flex items-center justify-between text-sm py-2">
                <label class="inline-flex items-center gap-2 select-none cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary/20" />
                    <span class="text-gray-600">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-primary font-semibold hover:text-primary/80 transition-colors">Forgot password?</a>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full py-3.5 rounded-xl bg-gray-900 text-white font-bold shadow-lg hover:bg-gray-800 transition-all active:scale-[.98]">
                Sign In
            </button>

            <div class="pt-4 text-center border-t border-gray-50">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                    © <span id="year"></span> Admin Portal. Secure Encryption Enabled.
                </p>
            </div>
        </form>
    </div>

    <script>
        // Set year
        document.getElementById('year').textContent = new Date().getFullYear();

        // Toggle password visibility
        const togglePass = document.getElementById('togglePass');
        const passInput = document.getElementById('adminPassword');
        togglePass.addEventListener('click', () => {
            const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passInput.setAttribute('type', type);
            togglePass.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script>
</body>
</html>
