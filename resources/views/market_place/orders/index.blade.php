@extends('market_place.layouts.dashboard-base')
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        @include('market_place.partials.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-6">My Orders</h2>

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
                                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-2">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-3 px-2">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="py-3 px-2 text-right">
                                    <a href="{{ route('client.orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
