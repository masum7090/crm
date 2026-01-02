@extends('market_place.layouts.dashboard-base')

@section('dashboard_content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800">My Orders</h2>
        </div>

        <!-- Filters Section -->
        <div class="mb-8 p-6 bg-gray-50 border border-gray-100 rounded-2xl">
            <form action="{{ route('client.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Search Order ID</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="e.g. 123" 
                               class="w-full pl-10 pr-4 py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        <svg class="absolute left-3.5 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Status</label>
                    <select name="status" class="w-full py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all cursor-pointer">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Date From -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                           class="w-full py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Date To -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                           class="w-full py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Min Amount -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Min Amount</label>
                    <input type="number" name="min_amount" value="{{ request('min_amount') }}" placeholder="0.00" step="0.01"
                           class="w-full py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Max Amount -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Max Amount</label>
                    <input type="number" name="max_amount" value="{{ request('max_amount') }}" placeholder="1000.00" step="0.01"
                           class="w-full py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>

                <!-- Per Page -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Per Page</label>
                    <select name="per_page" class="w-full py-2.5 text-sm border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all cursor-pointer">
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 results</option>
                        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 results</option>
                        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 results</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-end gap-3">
                    <button type="submit" class="flex-1 bg-gray-900 hover:bg-black text-white text-sm px-6 py-2.5 rounded-xl transition-all font-semibold shadow-sm active:scale-[0.98]">
                        Filter
                    </button>
                    <a href="{{ route('client.orders.index') }}" class="flex-1 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm px-6 py-2.5 rounded-xl transition-all font-semibold text-center shadow-sm">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                <tr class="border-b text-gray-600 text-left">
                    <th class="py-3 px-2">Order ID</th>
                    <th class="py-3 px-2">Status</th>
                    <th class="py-3 px-2">Total Amount</th>
                    <th class="py-3 px-2">Date</th>
                    <th class="py-3 px-2 text-right">Action</th>
                </tr>
                </thead>

                <tbody class="text-gray-800">
                @forelse ($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-2">#{{ $order->id }}</td>
                        <td class="py-3 px-2">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status == 'pending' ? 'bg-yellow-101 text-yellow-700' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-2">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                        <td class="py-3 px-2">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="py-3 px-2 text-right">
                            <a href="{{ route('client.orders.show', $order->id) }}" class="text-blue-600 hover:underline font-medium">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-8">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
