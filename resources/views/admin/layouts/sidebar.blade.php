<aside
        class="fixed left-0 top-14 bottom-0 w-64 lg:w-64 bg-white dark:bg-slate-800 border-r border-gray-200 dark:border-slate-700 z-40 overflow-y-auto -translate-x-full lg:translate-x-0 transition-all duration-300"
        id="sidebar">
        <nav class="py-4 px-3">
            <!-- Dashboard -->
            <div class="mb-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                      {{ request()->routeIs('admin.dashboard')
                          ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400'
                          : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div>

            <!-- Clients -->
            @php $isClientsActive = request()->routeIs('admin.clients.*'); @endphp
            <div class="mb-1">
                <button onclick="toggleMenu('clientsMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isClientsActive ? 'bg-gray-50 dark:bg-slate-700/50' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        <span class="sidebar-text">Clients</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ $isClientsActive ? '' : '-rotate-90' }}" id="chevron-clientsMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="clientsMenu" class="mt-1 space-y-1 {{ $isClientsActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.clients.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.clients.index') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Client List</span>
                    </a>
                </div>
            </div>

            <!-- Billing -->
            @php $isBillingActive = request()->routeIs('admin.orders.*') || request()->routeIs('admin.invoices.*'); @endphp
            <div class="mb-1">
                <button onclick="toggleMenu('billingMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isBillingActive ? 'bg-gray-50 dark:bg-slate-700/50' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        <span class="sidebar-text">Billing</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ $isBillingActive ? '' : '-rotate-90' }}" id="chevron-billingMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="billingMenu" class="mt-1 space-y-1 {{ $isBillingActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.orders.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('admin.invoices.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.invoices.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Invoices</span>
                    </a>
                </div>
            </div>

            <!-- Base Settings -->
            @php
                $isBaseActive = request()->routeIs('admin.categories.*') ||
                              request()->routeIs('admin.countries.*') ||
                              request()->routeIs('admin.providers.*') ||
                              request()->routeIs('admin.domain-extensions.*');
            @endphp
            <div class="mb-1">
                <button onclick="toggleMenu('baseSettingsMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isBaseActive ? 'bg-gray-50 dark:bg-slate-700/50' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span class="sidebar-text">Base Settings</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ $isBaseActive ? '' : '-rotate-90' }}" id="chevron-baseSettingsMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="baseSettingsMenu" class="mt-1 space-y-1 {{ $isBaseActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('admin.countries.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.countries.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Countries</span>
                    </a>
                    <a href="{{ route('admin.providers.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.providers.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Providers</span>
                    </a>
                    <a href="{{ route('admin.domain-extensions.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.domain-extensions.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Domain Extensions</span>
                    </a>
                </div>
            </div>

            <!-- Products Group -->
            <div class="px-3 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Products & Services</div>

            <!-- Domains -->
            <div class="mb-1">
                <button onclick="toggleMenu('domainsMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        <span class="sidebar-text">Domains</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform -rotate-90" id="chevron-domainsMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="domainsMenu" class="mt-1 space-y-1 {{ request()->routeIs('admin.domain-orders.*') ? '' : 'hidden' }}">
                    <a href="{{ route('admin.domain-orders.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.domain-orders.*') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Managed Domains</span>
                    </a>
                </div>
            </div>

            <!-- Hosting -->
            @php $isHostingActive = request()->routeIs('admin.hosting.*'); @endphp
            <div class="mb-1">
                <button onclick="toggleMenu('hostingMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isHostingActive ? 'bg-gray-50 dark:bg-slate-700/50' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                            <line x1="6" y1="6" x2="6.01" y2="6"></line>
                            <line x1="6" y1="18" x2="6.01" y2="18"></line>
                        </svg>
                        <span class="sidebar-text">Hosting</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ $isHostingActive ? '' : '-rotate-90' }}" id="chevron-hostingMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="hostingMenu" class="mt-1 space-y-1 {{ $isHostingActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.hosting.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.hosting.index') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>All Hosting Plans</span>
                    </a>
                    <a href="{{ route('admin.hosting.create') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.hosting.create') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Add New Plan</span>
                    </a>
                </div>
            </div>

            <!-- Apps Group -->
            <div class="px-3 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">System & Settings</div>

            <!-- Apps -->
            <div class="mb-1">
                <button onclick="toggleMenu('appsMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span class="sidebar-text">Apps</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform -rotate-90" id="chevron-appsMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="appsMenu" class="mt-1 space-y-1 hidden">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <span>Calendar</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <span>Chat</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <span>Email</span>
                    </a>
                </div>
            </div>

            <!-- Settings -->
            @php $isSettingsActive = request()->routeIs('admin.mail.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.settings.*'); @endphp
            <div class="mb-1">
                <button onclick="toggleMenu('settingsMenu')"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isSettingsActive ? 'bg-gray-50 dark:bg-slate-700/50' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span class="sidebar-text">Settings</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ $isSettingsActive ? '' : '-rotate-90' }}" id="chevron-settingsMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div id="settingsMenu" class="mt-1 space-y-1 {{ $isSettingsActive ? '' : 'hidden' }}">
                    <a href="{{ route('admin.mail.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.mail.index') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Mail Settings</span>
                    </a>
                    <a href="{{ route('admin.roles.index') }}"
                       class="flex items-center gap-3 px-3 py-2 ml-9 rounded-lg text-sm transition-all
                       {{ request()->routeIs('admin.roles.index') ? 'text-blue-600 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                        <span>Roles</span>
                    </a>
                </div>
            </div>
        </nav>
    </aside>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const chevron = document.getElementById('chevron-' + id);

            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                if (chevron) chevron.classList.remove('-rotate-90');
            } else {
                menu.classList.add('hidden');
                if (chevron) chevron.classList.add('-rotate-90');
            }
        }
    </script>
