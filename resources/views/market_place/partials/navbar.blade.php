<nav class="w-full border-b bg-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <div class="flex items-center gap-2">
            <img src="{{ asset('picon.png') }}" class="h-10 w-10 rounded-lg shadow-sm">
            <span class="font-bold text-xl tracking-wide">PITOR</span>
        </div>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="#">Pricing</a>
            <a href="#">Services ▾</a>
            <a href="#">Explore ▾</a>
            <a href="#">Support</a>
            <a href="#">Self-hosted n8n</a>
        </div>

        <div class="flex items-center gap-4">
            <button class="px-3 py-1 text-sm rounded-full border">🇺🇸 English</button>
            <a href="{{ route('login') }}">
                <button class="px-5 py-2 rounded-xl bg-black text-white text-sm">Login</button>
            </a>
        </div>

    </div>
</nav>
