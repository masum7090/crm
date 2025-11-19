<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

<!-- NAVBAR -->
<nav class="w-full border-b bg-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('picon.png') }}" alt="Project Icon" class="h-10 w-10 rounded-lg shadow-sm animate-glow">
            </div>
            <span class="font-bold text-xl tracking-wide">PITOR</span>
        </div>

        <!-- Links -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="#" class="hover:text-gray-900">Pricing</a>

            <div class="relative group">
                <button class="hover:text-gray-900 flex items-center gap-1">
                    Services
                    <span>▾</span>
                </button>
            </div>

            <div class="relative group">
                <button class="hover:text-gray-900 flex items-center gap-1">
                    Explore
                    <span>▾</span>
                </button>
            </div>

            <a href="#" class="hover:text-gray-900">Support</a>

            <a href="#" class="hover:text-gray-900">Self-hosted n8n</a>
        </div>

        <div class="flex items-center gap-4">
            <button class="px-3 py-1 text-sm rounded-full border">
                🇺🇸 English
            </button>
            <a href="{{ route('login') }}">
                <button class="px-5 py-2 rounded-xl bg-black text-white text-sm font-medium">
                    Login
                </button>
            </a>
        </div>
    </div>
</nav>

<!-- HERO TITLE -->
<section class="py-16">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            Search Your Domain</h1>
    </div>
</section>

<!-- SEARCH TAB BUTTONS -->
<div class="flex justify-center mt-4">
    <div class="inline-flex rounded-full border p-1 bg-gray-100">
        <button class="px-6 py-2 text-sm rounded-full bg-white shadow font-medium">
            Domain search
        </button>
    </div>
</div>

<!-- SEARCH BAR -->
<div class="max-w-3xl mx-auto px-6 mt-8 relative">
    <input
        type="text"
        placeholder="demo.com"
        class="w-full border rounded-full py-4 pl-6 pr-14 text-lg shadow-sm focus:outline-none"
    />

    <button class="absolute right-8 top-1/2 -translate-y-1/2 border border-gray-300 p-3 rounded-full bg-white hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="2"
             stroke="currentColor"
             class="w-5 h-5 text-gray-600">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
    </button>

</div>

<!-- RESULTS GRID -->
<section class="max-w-6xl mx-auto px-6 mt-12 grid md:grid-cols-3 gap-8">

    <!-- CARD 1 -->
    <div class="border rounded-2xl p-8 shadow-sm hover:shadow-md transition bg-white">
        <span class="text-xs font-bold bg-green-500 text-white px-2 py-1 rounded">EXACT MATCH</span>

        <h2 class="text-xl font-semibold mt-3">
            demo.com
        </h2>

        <p class="mt-4 text-gray-700 text-sm font-medium">
            Best value for 3 year term
        </p>

        <div class="mt-2">
            <span class="text-2xl font-bold">US$ 0.01</span>
            <span class="text-gray-500">/1st yr</span>
        </div>

        <button class="mt-6 w-full bg-[#006CBE] text-white font-medium py-3 rounded-xl hover:bg-[#005BA2]">
            Make it yours
        </button>

    </div>

    <!-- CARD 2 -->
    <div class="border rounded-2xl p-8 shadow-sm hover:shadow-md transition bg-white">

            <span class="text-xs font-bold bg-blue-600 text-white px-2 py-1 rounded">
                BUNDLE & SAVE
            </span>

        <h2 class="text-xl font-semibold mt-3">
            demo.com + .org + .net
        </h2>
        <p class="mt-4 text-gray-700 text-sm font-medium">
            Best value for 3 year term
        </p>
        <div class="mt-4">
            <span class="text-2xl font-bold">US$ 32.97</span>
            <span class="text-gray-500">/1st yr</span>
        </div>

        <button class="mt-6 w-full bg-[#006CBE] text-white font-medium py-3 rounded-xl hover:bg-[#005BA2]">
            Make it yours
        </button>
    </div>

    <!-- CARD 3 -->
    <div class="border rounded-2xl p-8 shadow-sm hover:shadow-md transition bg-white">

            <span class="text-xs font-bold bg-blue-600 text-white px-2 py-1 rounded">
                BUNDLE & SAVE
            </span>

        <h2 class="text-xl font-semibold mt-3">
            demo.com + .org + .net
        </h2>
        <p class="mt-4 text-gray-700 text-sm font-medium">
            Best value for 3 year term
        </p>
        <div class="mt-4">
            <span class="text-2xl font-bold">US$ 32.97</span>
            <span class="text-gray-500">/1st yr</span>
        </div>

        <button class="mt-6 w-full bg-[#006CBE] text-white font-medium py-3 rounded-xl hover:bg-[#005BA2]">
            Make it yours
        </button>
    </div>
</section>

</section>


<div class="mt-8 flex flex-wrap gap-3 justify-center text-sm">
    <button class="px-4 py-2 border rounded-full">Popular</button>
    <button class="px-4 py-2 border rounded-full">Business</button>
    <button class="px-4 py-2 border rounded-full">Technology</button>
    <button class="px-4 py-2 border rounded-full">Professional</button>
    <button class="px-4 py-2 border rounded-full">All</button>
</div>
</section>

<section class="max-w-5xl mx-auto mt-10">
    <div class="space-y-4">
        <div class="flex justify-between items-center border p-4 rounded-lg">
            <div>
                <p class="font-bold">xyz.tech</p>
                <span class="text-green-600 text-xs">PREMIUM · SAVE 77%</span>
            </div>
            <div class="text-right">
                <p class="font-bold">US$ 1500.00/1st yr</p>
                <button class="mt-2 px-4 py-1 bg-blue-600 text-white rounded">Buy now</button>
            </div>
        </div>
        <div class="flex justify-between items-center border p-4 rounded-lg">
            <div>
                <p class="font-bold">xyz.studio</p>
                <span class="text-green-600 text-xs">SAVE 72%</span>
            </div>
            <div class="text-right">
                <p class="font-bold">US$ 12.99/1st yr</p>
                <button class="mt-2 px-4 py-1 bg-blue-600 text-white rounded">Buy now</button>
            </div>
        </div>
        <div class="flex justify-between items-center border p-4 rounded-lg">
            <div>
                <p class="font-bold">xyz.store</p>
                <span class="text-green-600 text-xs">PREMIUM · SAVE 77%</span>
            </div>
            <div class="text-right">
                <p class="font-bold">US$ 750.00/1st yr</p>
                <button class="mt-2 px-4 py-1 bg-blue-600 text-white rounded">Buy now</button>
            </div>
        </div>
    </div>
</section>

<footer class="mt-20 bg-gray-100 p-10 text-center text-gray-500 text-sm">
    <p>© 2025 masum — Demo Layout</p>
</footer>
<script>
    // Mobile Menu Toggle
    document.getElementById('menuBtn').addEventListener('click', () => {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    });
</script>
</body>
</html>
