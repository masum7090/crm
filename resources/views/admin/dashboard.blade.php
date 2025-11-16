<x-admin-layout>
    <x-page-header title="Dashboard" description="Welcome back! Here's what's happening with your projects today."
        :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Dashboard']]" />

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div
            class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Users</div>
                    <div class="text-2xl font-bold">2,543</div>
                    <div class="flex items-center gap-1 text-sm text-green-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +12.5%
                        <span class="text-gray-500 dark:text-gray-400 ml-1">from last month</span>
                    </div>
                </div>
                <div
                    class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary transition-transform hover:scale-110">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Active Projects</div>
                    <div class="text-2xl font-bold">124</div>
                    <div class="flex items-center gap-1 text-sm text-green-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +8.2%
                        <span class="text-gray-500 dark:text-gray-400 ml-1">from last month</span>
                    </div>
                </div>
                <div
                    class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary transition-transform hover:scale-110">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Revenue</div>
                    <div class="text-2xl font-bold">$45,231</div>
                    <div class="flex items-center gap-1 text-sm text-green-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +15.3%
                        <span class="text-gray-500 dark:text-gray-400 ml-1">from last month</span>
                    </div>
                </div>
                <div
                    class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary transition-transform hover:scale-110">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Reports Generated</div>
                    <div class="text-2xl font-bold">892</div>
                    <div class="flex items-center gap-1 text-sm text-red-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                            <polyline points="17 18 23 18 23 12"></polyline>
                        </svg>
                        -3.1%
                        <span class="text-gray-500 dark:text-gray-400 ml-1">from last month</span>
                    </div>
                </div>
                <div
                    class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary transition-transform hover:scale-110">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="20" x2="12" y2="10"></line>
                        <line x1="18" y1="20" x2="18" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="16"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Chart Card -->
        <div
            class="lg:col-span-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Overview</h2>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-primary-hover transition-colors">Week</button>
                    <button
                        class="px-4 py-2 bg-gray-100 dark:bg-slate-700 rounded-md text-sm font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">Month</button>
                    <button
                        class="px-4 py-2 bg-gray-100 dark:bg-slate-700 rounded-md text-sm font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">Year</button>
                </div>
            </div>
            <div
                class="h-[300px] flex flex-col items-center justify-center bg-gray-100 dark:bg-slate-700 border-2 border-dashed border-gray-300 dark:border-slate-600 rounded-lg text-gray-500 dark:text-gray-400">
                <div class="text-5xl mb-4">📊</div>
                <p>Chart visualization</p>
                <p class="text-xs mt-2">Integrate your preferred charting library</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Recent Activity</h2>
                <button
                    class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-md text-sm font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">View
                    All</button>
            </div>
            <div class="flex flex-col gap-4">
                <div
                    class="flex gap-4 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-medium">John Doe</span>
                            <span
                                class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">Created</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">New Project Alpha</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">2 minutes ago</p>
                    </div>
                    <div class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0 mt-2"></div>
                </div>

                <div
                    class="flex gap-4 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-medium">Sarah Smith</span>
                            <span
                                class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">Updated</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">User Profile</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">15 minutes ago</p>
                    </div>
                    <div class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0 mt-2"></div>
                </div>

                <div
                    class="flex gap-4 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-medium">Mike Johnson</span>
                            <span
                                class="px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400">Deleted</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Old Report</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">1 hour ago</p>
                    </div>
                    <div class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0 mt-2"></div>
                </div>

                <div
                    class="flex gap-4 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-medium">Emily Davis</span>
                            <span
                                class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">Uploaded</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Design Files</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">2 hours ago</p>
                    </div>
                    <div class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0 mt-2"></div>
                </div>

                <div
                    class="flex gap-4 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-medium">Alex Wilson</span>
                            <span
                                class="px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400">Modified</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Settings</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">3 hours ago</p>
                    </div>
                    <div class="w-2 h-2 rounded-full bg-yellow-500 flex-shrink-0 mt-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Performance Metrics -->
        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Performance Metrics</h3>
                <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                    <polyline points="17 6 23 6 23 12"></polyline>
                </svg>
            </div>
            <div>
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2 text-sm">
                        <span class="text-gray-500 dark:text-gray-400">User Engagement</span>
                        <span class="font-medium">78%</span>
                    </div>
                    <div class="h-2 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full transition-all duration-1000 ease-out"
                            style="width: 78%"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2 text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Task Completion</span>
                        <span class="font-medium">92%</span>
                    </div>
                    <div class="h-2 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full transition-all duration-1000 ease-out"
                            style="width: 92%"></div>
                    </div>
                </div>
                <div class="mb-0">
                    <div class="flex justify-between items-center mb-2 text-sm">
                        <span class="text-gray-500 dark:text-gray-400">System Uptime</span>
                        <span class="font-medium">99.9%</span>
                    </div>
                    <div class="h-2 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full transition-all duration-1000 ease-out"
                            style="width: 99.9%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm">
            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-3">
                <button
                    class="p-4 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 hover:-translate-y-0.5 hover:shadow-md transition-all text-left">
                    <div class="text-2xl mb-2">👥</div>
                    <div class="text-sm font-medium">Add User</div>
                </button>
                <button
                    class="p-4 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 hover:-translate-y-0.5 hover:shadow-md transition-all text-left">
                    <div class="text-2xl mb-2">📁</div>
                    <div class="text-sm font-medium">New Project</div>
                </button>
                <button
                    class="p-4 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 hover:-translate-y-0.5 hover:shadow-md transition-all text-left">
                    <div class="text-2xl mb-2">📊</div>
                    <div class="text-sm font-medium">Generate Report</div>
                </button>
                <button
                    class="p-4 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 hover:-translate-y-0.5 hover:shadow-md transition-all text-left">
                    <div class="text-2xl mb-2">⚙️</div>
                    <div class="text-sm font-medium">Settings</div>
                </button>
            </div>
        </div>
    </div>
</x-admin-layout>
