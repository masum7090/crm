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
                    <div class="text-2xl font-bold">{{ number_format($total_clients) }}</div>
                    <div class="flex items-center gap-1 text-sm text-green-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +100%
                        <span class="text-gray-500 dark:text-gray-400 ml-1">all time</span>
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
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Orders</div>
                    <div class="text-2xl font-bold">{{ number_format($total_orders) }}</div>
                    <div class="flex items-center gap-1 text-sm text-green-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        Active
                        <span class="text-gray-500 dark:text-gray-400 ml-1">orders</span>
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
                    <div class="text-2xl font-bold">${{ number_format($total_revenue, 2) }}</div>
                    <div class="flex items-center gap-1 text-sm text-green-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        Paid
                        <span class="text-gray-500 dark:text-gray-400 ml-1">invoices</span>
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
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Pending Orders</div>
                    <div class="text-2xl font-bold">{{ number_format($pending_orders) }}</div>
                    <div class="flex items-center gap-1 text-sm text-yellow-600 mt-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        Awaiting
                        <span class="text-gray-500 dark:text-gray-400 ml-1">action</span>
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
        <!-- Chart Card (Keep Static for now, visualization only) -->
        <div
            class="lg:col-span-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}"
                    class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-md text-sm font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">View
                    All</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-slate-700">
                            <th class="pb-3 pr-4">Order ID</th>
                            <th class="pb-3 pr-4">Client</th>
                            <th class="pb-3 pr-4">Total</th>
                            <th class="pb-3 pr-4">Status</th>
                            <th class="pb-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-slate-700/50">
                        @forelse($recent_orders as $order)
                        <tr>
                            <td class="py-4 text-sm font-medium">#{{ $order->id }}</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $order->user->name ?? 'Deleted User' }}
                            </td>
                            <td class="py-4 text-sm font-bold text-gray-900 dark:text-white">
                                ${{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="py-4">
                                <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($order->status == 'completed') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                                    @else bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 text-xs text-gray-500">
                                {{ $order->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-400 italic">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Activity (New Users) -->
        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">New Clients</h2>
                <a href="{{ route('admin.clients.index') }}"
                    class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-md text-sm font-medium hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">View
                    All</a>
            </div>
            <div class="flex flex-col gap-4">
                @forelse($recent_users as $user)
                <div
                    class="flex gap-4 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors cursor-pointer border border-transparent hover:border-gray-200 dark:hover:border-slate-600">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary flex-shrink-0">
                        <span class="font-bold text-xs">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                        <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-1 font-medium">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-500 flex-shrink-0 mt-2"></div>
                </div>
                @empty
                <p class="text-center text-gray-400 italic py-4">No new clients</p>
                @endforelse
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
