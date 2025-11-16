<header
    class="fixed top-0 left-0 right-0 h-14 bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 flex items-center justify-between px-4 z-50 shadow-sm">
    <div class="flex items-center gap-3">
        <button
            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors"
            id="menuBtn">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
        <div class="flex items-center gap-2">
                 <link rel="icon" type="image/png" href="{{ asset('picon.png') }}">
            {{-- <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-sm">
            </div> --}}
            <img src="{{ asset('picon.png') }}" alt="Project Icon" class="h-8 w-8 rounded-lg ">

            <span class="text-lg font-semibold hidden sm:block sidebar-text">Pitor CRM</span>
        </div>
    </div>

    <div class="hidden md:block flex-1 max-w-md mx-4 relative">
        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
        </svg>
        <input type="search"
            class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-100 dark:bg-slate-700 border border-transparent focus:bg-white dark:focus:bg-slate-800 focus:border-gray-200 dark:focus:border-slate-600 outline-none transition-all"
            placeholder="Search...">
    </div>

    <div class="flex items-center gap-2">
        <button
            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors"
            id="themeBtn">
            <svg class="w-5 h-5" id="moonIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
            <svg class="w-5 h-5 hidden" id="sunIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
        </button>

        <div class="relative" id="notificationDropdown">
            <button
                class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors relative">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <div class="absolute top-full right-0 mt-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-lg min-w-[200px] opacity-0 invisible translate-y-[-10px] transition-all pointer-events-none"
                id="notificationMenu">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 font-semibold text-sm">
                    Notifications</div>
                <button class="w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors">
                    <div class="font-medium mb-1">New user registered</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">2 minutes ago</div>
                </button>
                <button class="w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors">
                    <div class="font-medium mb-1">Report generated</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">1 hour ago</div>
                </button>
                <button class="w-full px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors">
                    <div class="font-medium mb-1">System update available</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">3 hours ago</div>
                </button>
            </div>
        </div>

        <div class="relative" id="userDropdown">
            <button
                class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="hidden lg:block text-left sidebar-text">
                    <div class="text-sm font-medium">Admin User</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">admin@crm.com</div>
                </div>
                <svg class="w-4 h-4 sidebar-text" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div class="absolute top-full right-0 mt-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-lg min-w-[200px] opacity-0 invisible translate-y-[-10px] transition-all pointer-events-none"
                id="userMenu">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 font-semibold text-sm">My Account
                </div>
                <a href="{{ route("admin.profile.edit") }}"
                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors text-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Profile
                </a>
                <button
                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors text-sm">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M12 1v6m0 6v6"></path>
                    </svg>
                    Settings
                </button>
                <div class="h-px bg-gray-200 dark:bg-slate-700 my-1"></div>
                {{-- <button class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors text-sm text-red-500">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log out
                    </button> --}}

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-100 dark:hover:bg-slate-700 text-left transition-colors text-sm text-red-500">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log out (Admin)
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
