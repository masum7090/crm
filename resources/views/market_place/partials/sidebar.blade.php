<aside class="w-64 bg-white border-r shadow-sm hidden md:flex flex-col">

    <nav class="flex-1 px-4 py-4 space-y-2 text-sm">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-sky-600 text-white' : 'hover:bg-gray-100' }}">
            <span>🏠</span>
            Customer Dashboard
        </a>

        <!-- Domains -->
        <div>
            <button onclick="toggleMenu('domainsMenu')"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-lg hover:bg-gray-100">
                <span class="flex items-center gap-3">🌐 Domains</span>
                <span>▾</span>
            </button>

            <div id="domainsMenu" class="ml-8 mt-2 space-y-1 hidden">
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    All Domains
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Register Domain
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Transfer Domain
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    DNS Management
                </a>
            </div>
        </div>

        <!-- Hosting -->
        <div>
            <button onclick="toggleMenu('hostingMenu')"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-lg hover:bg-gray-100">
                <span class="flex items-center gap-3">🖥 Hosting</span>
                <span>▾</span>
            </button>

            <div id="hostingMenu" class="ml-8 mt-2 space-y-1 hidden">
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Shared Hosting
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    VPS Hosting
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Dedicated Server
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Reseller Hosting
                </a>
            </div>
        </div>

        <!-- Services -->
        <div>
            <button onclick="toggleMenu('servicesMenu')"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-lg hover:bg-gray-100">
                <span class="flex items-center gap-3">🛠 Services</span>
                <span>▾</span>
            </button>

            <div id="servicesMenu" class="ml-8 mt-2 space-y-1 hidden">
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Email Hosting
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    SSL Certificates
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Website Builder
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Domain Privacy
                </a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">
                    Backup Services
                </a>
            </div>
        </div>

        <!-- Billing -->
        <div>
            <button onclick="toggleMenu('billingMenu')"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-lg hover:bg-gray-100">
                <span class="flex items-center gap-3">💳 Billing</span>
                <span>▾</span>
            </button>

            <div id="billingMenu" class="ml-8 mt-2 space-y-1 {{ request()->routeIs('client.orders.*', 'client.invoices.*') ? '' : 'hidden' }}">
                <a href="{{ route('client.orders.index') }}" class="block px-3 py-2 rounded {{ request()->routeIs('client.orders.*') ? 'bg-gray-100 font-semibold' : 'hover:bg-gray-100' }}">
                    My Orders
                </a>
                <a href="{{ route('client.invoices.index') }}" class="block px-3 py-2 rounded {{ request()->routeIs('client.invoices.*') ? 'bg-gray-100 font-semibold' : 'hover:bg-gray-100' }}">
                    My Invoices
                </a>
            </div>
        </div>

        <!-- Users -->
        <a href="{{ route('admin.clients.edit', Auth::user()) }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100">
            👤 Users
        </a>

        <!-- Settings -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100">
            ⚙️ Settings
        </a>

    </nav>

</aside>

<script>
    function toggleMenu(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
