@extends('market_place.layouts.dashboard-base')
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        @include('market_place.partials.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white rounded-xl shadow p-6 max-w-4xl mx-auto">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Order #{{ $order->id }} Details</h2>
                    <a href="{{ route('client.orders.index') }}" class="text-sm text-gray-500 hover:underline">← Back to Orders</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Order Info</h3>
                        <p><span class="font-medium">Date:</span> {{ $order->created_at->format('M d, Y') }}</p>
                        <p><span class="font-medium">Status:</span> 
                            <span class="px-2 py-0.5 text-xs rounded-full 
                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                     <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Invoice</h3>
                        @if ($order->invoice)
                            <a href="{{ route('client.invoices.show', $order->invoice->id) }}" class="text-blue-600 hover:underline flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                View Invoice #{{ $order->invoice->invoice_number }}
                            </a>
                        @else
                            <span class="text-gray-400">Not generated yet</span>
                        @endif
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-4">Items</h3>
                <div class="border rounded-lg overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-gray-500">
                                <th class="py-3 px-4">Description</th>
                                <th class="py-3 px-4 text-center">Qty</th>
                                <th class="py-3 px-4 text-right">Price</th>
                                <th class="py-3 px-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr class="border-t">
                                    <td class="py-3 px-4">
                                        <div class="font-medium text-gray-900">{{ $item->description }}</div>
                                    </td>
                                    <td class="py-3 px-4 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 px-4 text-right">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-3 px-4 text-right font-medium">{{ number_format($item->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="py-4 px-4 text-right font-semibold text-gray-700">Total</td>
                                <td class="py-4 px-4 text-right font-bold text-lg text-gray-900">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>
