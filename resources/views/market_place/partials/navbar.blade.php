<nav class="w-full border-b bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <div class="flex items-center gap-2">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('picon.png') }}" class="h-10 w-10 rounded-lg shadow-sm">
                <span class="font-bold text-xl tracking-wide uppercase">PITOR</span>
            </a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <!-- Domains Dropdown -->
            <div class="relative group">
                <a href="/" class="flex items-center gap-1 hover:text-blue-600 transition-colors py-2">
                    Domains
                    <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:mt-2 transition-all duration-300 z-50">
                    <div class="py-3">
                        <a href="/" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Domain Search</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Domain Transfer</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Domain Registration</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Bulk Domain Search</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">WHOIS Lookup</a>
                    </div>
                </div>
            </div>

            <!-- Hosting Dropdown (Enabled Submenu) -->
            <div class="relative group">
                <a href="{{ route('hosting.index') }}" class="flex items-center gap-1 hover:text-blue-600 transition-colors py-2">
                    Hosting
                    <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="absolute left-0 mt-0 w-64 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:mt-2 transition-all duration-300 z-50">
                    <div class="py-3 px-1">
                        <div class="px-5 py-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-widest">Our Solutions</div>
                        <a href="{{ route('hosting.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-blue-50 hover:text-blue-600 text-gray-700 rounded-lg transition-colors">
                            <span class="p-2 bg-blue-100 rounded-lg text-blue-600">🌐</span>
                            <div>
                                <div class="font-bold text-sm">All Hosting Plans</div>
                                <div class="text-[10px] opacity-70">Compare all our products</div>
                            </div>
                        </a>
                        <div class="h-px bg-gray-50 my-2 mx-5"></div>
                        <a href="{{ route('hosting.index') }}#shared" class="block px-5 py-2 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Shared Hosting</a>
                        <a href="{{ route('hosting.index') }}#vps" class="block px-5 py-2 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">VPS Hosting</a>
                        <a href="{{ route('hosting.index') }}#dedicated" class="block px-5 py-2 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Dedicated Servers</a>
                        <a href="{{ route('hosting.index') }}#reseller" class="block px-5 py-2 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Reseller Hosting</a>
                        <a href="{{ route('hosting.index') }}#wordpress" class="block px-5 py-2 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">WordPress Hosting</a>
                    </div>
                </div>
            </div>

            <!-- Services Dropdown -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-blue-600 transition-colors py-2">
                    Services
                    <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
                <div class="absolute left-0 mt-0 w-64 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:mt-2 transition-all duration-300 z-50">
                    <div class="py-3">
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">SSL Certificates</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Email Hosting</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Website Builder</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Website Security</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">CDN Services</a>
                        <a href="#" class="block px-6 py-2.5 hover:bg-blue-50 hover:text-blue-600 text-gray-700 transition-colors">Backup Solutions</a>
                    </div>
                </div>
            </div>

            <a href="{{ route('contact') }}" class="hover:text-blue-600 transition-colors">Contact Us</a>
        </div>

        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-2">
                <button class="px-3 py-1 text-sm rounded-full border hover:bg-gray-50 transition-colors">🇺🇸 English</button>
            </div>
            
            @auth
                <a href="{{ route('dashboard') }}">
                    <button class="px-5 py-2 rounded-xl bg-blue-600 text-white text-sm font-bold shadow-md hover:bg-blue-700 transition-all transform hover:scale-105 active:scale-95">Dashboard</button>
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden sm:inline">
                    <button class="px-5 py-2 text-sm font-semibold hover:text-blue-600 transition-colors">Login</button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="px-5 py-2 rounded-xl bg-black text-white text-sm font-bold shadow-md hover:bg-gray-800 transition-all transform hover:scale-105 active:scale-95">Get Started</button>
                </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-gray-600 hover:text-blue-600 focus:outline-none">
                <svg id="menuIcon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
                <svg id="closeIcon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Container -->
    <div id="mobileMenu" class="hidden md:hidden absolute w-full bg-white border-b shadow-2xl z-40 overflow-hidden transition-all duration-300">
        <div class="px-6 py-8 space-y-6">
            <div>
                <button onclick="toggleMobileSub('mobileHosting')" class="flex items-center justify-between w-full text-lg font-bold text-gray-800">
                    Hosting
                    <svg class="w-5 h-5 transition-transform" id="mobileHostingArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobileHosting" class="hidden mt-4 ml-4 space-y-3 border-l-2 border-blue-100 pl-4">
                    <a href="{{ route('hosting.index') }}" class="block text-gray-600 hover:text-blue-600 transition-colors">All Hosting Plans</a>
                    <a href="{{ route('hosting.index') }}#shared" class="block text-gray-600 hover:text-blue-600 transition-colors">Shared Hosting</a>
                    <a href="{{ route('hosting.index') }}#vps" class="block text-gray-600 hover:text-blue-600 transition-colors">VPS Hosting</a>
                    <a href="{{ route('hosting.index') }}#dedicated" class="block text-gray-600 hover:text-blue-600 transition-colors">Dedicated Servers</a>
                    <a href="{{ route('hosting.index') }}#reseller" class="block text-gray-600 hover:text-blue-600 transition-colors">Reseller Hosting</a>
                </div>
            </div>
            
            <a href="/" class="block text-lg font-bold text-gray-800">Domains</a>
            <a href="#" class="block text-lg font-bold text-gray-800">Services</a>
            <a href="{{ route('contact') }}" class="block text-lg font-bold text-gray-800">Contact Us</a>
            
            <div class="pt-6 border-t flex flex-col gap-4">
                @guest
                    <a href="{{ route('login') }}" class="w-full text-center py-3 font-bold text-gray-800 border-2 rounded-xl">Login</a>
                @endguest
                <a href="{{ route('register') }}" class="w-full text-center py-3 font-bold text-white bg-blue-600 rounded-xl shadow-lg">Get Started</a>
            </div>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        function toggleMobileSub(id) {
            const sub = document.getElementById(id);
            const arrow = document.getElementById(id + 'Arrow');
            
            sub.classList.toggle('hidden');
            if (arrow) arrow.classList.toggle('rotate-180');
        }
    </script>
</nav>

