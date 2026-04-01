<x-admin-layout>
    <x-page-header title="Orders" description="Manage customer orders."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Orders']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <h2 class="text-xl font-semibold">All Orders</h2>
            <a href="{{ route('admin.orders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-5 py-2.5 rounded-lg transition-colors font-medium shadow-sm">
                + Create Order
            </a>
        </div>

        <!-- Filters Section -->
        <div class="mb-8 p-5 bg-gray-50 dark:bg-slate-800/50 rounded-xl border border-gray-100 dark:border-slate-700">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Search</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Order ID, Client Name..." 
                               class="w-full pl-9 pr-4 py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</label>
                    <select name="status" class="w-full py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Date From -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                           class="w-full py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Date To -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                           class="w-full py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Min Amount -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Min Amount</label>
                    <input type="number" name="min_amount" value="{{ request('min_amount') }}" placeholder="0.00" step="0.01"
                           class="w-full py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Max Amount -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Max Amount</label>
                    <input type="number" name="max_amount" value="{{ request('max_amount') }}" placeholder="1000.00" step="0.01"
                           class="w-full py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Per Page -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Per Page</label>
                    <select name="per_page" class="w-full py-2 text-sm border-gray-200 dark:border-slate-600 dark:bg-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-end gap-3 lg:col-span-1">
                    <button type="submit" class="flex-1 bg-gray-800 hover:bg-gray-900 text-white text-sm px-4 py-2.5 rounded-lg transition-colors font-medium shadow-sm">
                        Apply
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="flex-1 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm px-4 py-2.5 rounded-lg transition-colors font-medium text-center shadow-sm">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <table class="w-full text-sm border-collapse">
            <thead>
            <tr class="border-b text-gray-600 text-left">
                <th class="py-3 px-2">Order ID</th>
                <th class="py-3 px-2">Client</th>
                <th class="py-3 px-2">Status</th>
                <th class="py-3 px-2">Total Amount</th>
                <th class="py-3 px-2">Date</th>
                <th class="py-3 px-2">Invoice</th>
                <th class="py-3 px-2 text-right">Action</th>
            </tr>
            </thead>

            <tbody class="text-gray-800">
            @forelse ($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-2">#{{ $order->id }}</td>
                    <td class="py-3 px-2">
                        @if($order->user)
                            <a href="{{ route('admin.clients.edit', $order->user->id) }}" class="text-blue-600 hover:underline">
                                {{ $order->user->name }}
                            </a>
                        @else
                            <span class="text-gray-400">Unknown Client</span>
                        @endif
                    </td>
                    <td class="py-3 px-2">
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-2">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-3 px-2">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="py-3 px-2">
                        @if ($order->invoice)
                            <a href="{{ route('admin.invoices.show', $order->invoice->id) }}" class="text-blue-600 hover:underline">
                                {{ $order->invoice->invoice_number }}
                            </a>
                        @else
                            <span class="text-gray-400">None</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-right">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500 py-4">
                        No orders found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
