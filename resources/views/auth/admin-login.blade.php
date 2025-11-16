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
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-slate-100 flex items-center justify-center overflow-hidden relative">

    <!-- Background shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-primary/30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/3 right-1/3 w-72 h-72 bg-accent/30 rounded-full blur-3xl animate-float [animation-delay:2s]"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md p-8 rounded-2xl backdrop-blur-xl bg-white/10 border border-white/10 shadow-2xl animate-fadeIn">
        <div class="px-6 pt-6 pb-3 text-center">
            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('picon.png') }}" alt="Project Icon" class="h-10 w-10 rounded-lg shadow-sm animate-glow">
            </div>
            <h1 class="mt-3 font-semibold text-lg">Welcome To Pitor</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Secure Access Only</p>
        </div>

        <!-- Laravel login form -->
        <form id="adminLogin" method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5" novalidate>
            @csrf

            <!-- Email -->
            <div class="relative">
                <input id="adminEmail" name="email" type="email" value="{{ old('email') }}" required placeholder=" "
                       class="peer w-full rounded-xl bg-white/5 border border-white/10 text-white placeholder-transparent px-4 pt-5 pb-2 outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary/40" />
                <label for="adminEmail"
                       class="absolute left-4 top-2 text-xs text-slate-400 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm">
                    Admin Email
                </label>
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <input id="adminPassword" name="password" type="password" required placeholder=" "
                       class="peer w-full rounded-xl bg-white/5 border border-white/10 text-white placeholder-transparent px-4 pt-5 pb-2 pr-10 outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary/40" />
                <label for="adminPassword"
                       class="absolute left-4 top-2 text-xs text-slate-400 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm">
                    Password
                </label>
                <button type="button" id="togglePass"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white">👁️</button>
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me + Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center gap-2 select-none">
                    <input type="checkbox" name="remember" class="rounded border-slate-600 text-primary focus:ring-primary/40" />
                    Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-primary hover:underline">Forgot password?</a>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full py-2.5 rounded-xl bg-gradient-to-r from-primary to-accent text-white font-medium shadow-lg hover:shadow-xl transition-transform active:scale-[.98]">
                Login
            </button>

            <p class="text-center text-xs text-slate-500 mt-4">
                © <span id="year"></span> Admin Portal. All rights reserved.
            </p>
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
