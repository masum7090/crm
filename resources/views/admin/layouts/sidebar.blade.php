    <aside
        class="fixed left-0 top-14 bottom-0 w-64 lg:w-64 bg-white dark:bg-slate-800 border-r border-gray-200 dark:border-slate-700 z-40 overflow-y-auto -translate-x-full lg:translate-x-0 transition-all duration-300"
        id="sidebar">
        <nav class="py-4 px-2">
            {{-- <div class="mb-1">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg bg-gray-100 dark:bg-slate-700 text-primary font-medium text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div> --}}

            <div class="mb-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.dashboard')
                          ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
                          : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div>

            <div class="mb-1">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="sidebar-text">Users</span>
                </a>
            </div>

            <div class="mb-1" data-expandable>
                <a href="javascript:void(0)"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span class="flex-1 sidebar-text">Clints</span>
                    <svg class="w-4 h-4 transition-transform sidebar-text" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <div class="max-h-0 overflow-hidden transition-all" data-children>
                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                            <span class="sidebar-text">Clint List</span>
                        </a>
                    </div>
                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span class="sidebar-text">Active</span>
                        </a>
                    </div>
                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                <rect x="1" y="3" width="22" height="5"></rect>
                            </svg>
                            <span class="sidebar-text">Archived</span>
                        </a>
                    </div>
                </div>
            </div>

<div class="ml-4 mt-1">
    <a href="{{ route('admin.clients.index') }}"
        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
        {{ request()->routeIs('admin.clients.*')
            ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
            : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M2 4h20M2 10h20M2 16h20M5 20h14" />
        </svg>
        <span class="sidebar-text">Clients</span>
    </a>
</div>


            <div class="ml-4 mt-1">
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
        {{ request()->routeIs('admin.categories.*')
            ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
            : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4h20M2 10h20M2 16h20M5 20h14" />
                    </svg>
                    <span class="sidebar-text">Categories</span>
                </a>
            </div>

            <div class="ml-4 mt-1">
                <a href="{{ route('admin.countries.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
        {{ request()->routeIs('admin.countries.*')
            ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
            : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4h20M2 10h20M2 16h20M5 20h14" />
                    </svg>
                    <span class="sidebar-text">Countries</span>
                </a>
            </div>

            <div class="ml-4 mt-1">
                <a href="{{ route('admin.providers.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
        {{ request()->routeIs('admin.providers.*')
            ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
            : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4h20M2 10h20M2 16h20M5 20h14" />
                    </svg>
                    <span class="sidebar-text">Providers</span>
                </a>
            </div>
               <div class="ml-4 mt-1">
                <a href="{{ route('admin.domain-extensions.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
        {{ request()->routeIs('admin.domain-extensions.*')
            ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
            : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 4h20M2 10h20M2 16h20M5 20h14" />
                    </svg>
                    <span class="sidebar-text">Domain Extensions</span>
                </a>
            </div>
            
             <div class="mb-1">
                 <a href="{{ route('admin.domains.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
         {{ request()->routeIs('admin.domains.*')
             ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
             : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                     <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                         <circle cx="12" cy="12" r="10"></circle>
                         <line x1="2" y1="12" x2="22" y2="12"></line>
                         <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                     </svg>
                     <span class="sidebar-text">Domains</span>
                 </a>
             </div>

            <div class="mb-1" data-expandable>
                <a href="javascript:void(0)"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span class="flex-1 sidebar-text">Apps</span>
                    <svg class="w-4 h-4 transition-transform sidebar-text" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <div class="max-h-0 overflow-hidden transition-all" data-children>
                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                </rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span class="sidebar-text">Calendar</span>
                        </a>
                    </div>
                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span class="sidebar-text">Chat</span>
                        </a>
                    </div>
                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <span class="sidebar-text">Email</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mb-1" data-expandable>
                <a href="javascript:void(0)"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="flex-1 sidebar-text">Billing</span>
                    <svg class="w-4 h-4 transition-transform sidebar-text" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <div class="max-h-0 overflow-hidden transition-all" data-children>
                    <div class="ml-4 mt-1">
                        <a href="{{ route('admin.orders.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                            {{ request()->routeIs('admin.orders.*') ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            <span class="sidebar-text">Orders</span>
                        </a>
                    </div>
                    <div class="ml-4 mt-1">
                        <a href="{{ route('admin.invoices.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                            {{ request()->routeIs('admin.invoices.*') ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium' : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                <line x1="2" y1="10" x2="22" y2="10"></line>
                            </svg>
                            <span class="sidebar-text">Invoices</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mb-1">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="20" x2="12" y2="10"></line>
                        <line x1="18" y1="20" x2="18" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="16"></line>
                    </svg>
                    <span class="sidebar-text">Reports</span>
                </a>
            </div>

            <div class="mb-1">
                <a href="#"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-sm transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M12 1v6m0 6v6"></path>
                    </svg>
                    <span class="sidebar-text">Settings</span>
                </a>
            </div>


            @php
                $isSettingsActive = request()->routeIs('admin.mail.*') || request()->routeIs('admin.settings.*');
            @endphp

            <div class="mb-1" data-expandable>
                <a href="javascript:void(0)"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm transition-colors
               {{ $isSettingsActive
                   ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
                   : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200' }}">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span class="flex-1 sidebar-text">Settings</span>
                    <svg class="w-4 h-4 transition-transform sidebar-text {{ $isSettingsActive ? 'rotate-180' : '' }}"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>

                <div class="overflow-hidden transition-all {{ $isSettingsActive ? 'max-h-40' : 'max-h-0' }}"
                    data-children>
                    <div class="ml-4 mt-1">
                        <a href="{{ route('admin.mail.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                       {{ request()->routeIs('admin.mail.index')
                           ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
                           : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                </rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span class="sidebar-text">Mail Settings</span>
                        </a>
                    </div>

                    <div class="ml-4 mt-1">
                        <a href="{{ route('admin.roles.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                       {{ request()->routeIs('admin.settings.chat')
                           ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
                           : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span class="sidebar-text">Roles</span>
                        </a>
                    </div>

                    <div class="ml-4 mt-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                       {{ request()->routeIs('admin.settings.email')
                           ? 'bg-gray-100 dark:bg-slate-700 text-primary font-medium'
                           : 'hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <span class="sidebar-text">Email</span>
                        </a>
                    </div>
                </div>
            </div>




        </nav>
    </aside>
