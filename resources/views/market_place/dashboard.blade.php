@extends('market_place.layouts.dashboard-base')

@section('dashboard_content')
    <div class="space-y-10">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-500">Manage your domains, hosting plans, and billing from your simplified dashboard.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100">
                    <div class="text-blue-600 font-bold text-sm uppercase mb-1">Total Orders</div>
                    <div class="text-3xl font-black text-blue-900">{{ $totalOrders }}</div>
                </div>
                <div class="p-6 bg-purple-50 rounded-2xl border border-purple-100">
                    <div class="text-purple-600 font-bold text-sm uppercase mb-1">Unpaid Invoices</div>
                    <div class="text-3xl font-black text-purple-900">{{ $unpaidInvoices }}</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold text-gray-800">My Services & Products</h2>
                <a href="{{ route('client.orders.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700">View All Orders &rarr;</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-y border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider">Product / Service</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider">Purchase Date</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-right">Price</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($purchasedItems as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-900">{{ $item->description ?: ($item->product ? $item->product->name : 'N/A') }}</div>
                                <div class="text-gray-400 text-xs mt-0.5">Order ID: #{{ $item->order_id }}</div>
                            </td>
                            <td class="px-6 py-5 text-gray-600 font-medium">
                                {{ $item->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-5 text-right font-black text-gray-900">
                                {{ number_format($item->amount, 2) }}
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-tighter rounded-full bg-green-100 text-green-700 border border-green-200">
                                    Active
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                No purchased services yet. 
                                <a href="/" class="text-blue-600 font-bold hover:underline ml-1">Explore Marketplace &rarr;</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
