@extends('market_place.layouts.dashboard-base')

@section('dashboard_content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
                <p class="text-gray-500 mt-1">Placed on {{ $order->created_at->format('M d, Y at H:i') }}</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="px-4 py-1.5 text-sm font-bold rounded-full 
                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $order->status == 'pending' ? 'bg-yellow-101 text-yellow-700' : '' }}
                    {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ strtoupper($order->status) }}
                </span>
                <a href="{{ route('client.orders.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                    &larr; Back to Orders
                </a>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Billing Information</h3>
                    <div class="text-gray-900 font-medium">{{ $order->user->name }}</div>
                    <div class="text-gray-600 text-sm mt-1">
                        {{ $order->user->email }}
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Invoice Details</h3>
                    @if ($order->invoice)
                        <div class="text-blue-600 font-bold hover:underline">
                            <a href="{{ route('client.invoices.show', $order->invoice->id) }}">
                                {{ $order->invoice->invoice_number }}
                            </a>
                        </div>
                        <div class="text-gray-500 text-sm mt-1">Status: {{ ucfirst($order->invoice->status) }}</div>
                    @else
                        <div class="text-gray-400 italic">No invoice generated</div>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 overflow-hidden mb-10">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider">Product / Service</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-center">Qty</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-right">Unit Price</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($order->items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-900">{{ $item->description ?: ($item->product ? $item->product->name : 'N/A') }}</div>
                                <div class="text-gray-400 text-xs mt-0.5">ID: {{ $item->product_id ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-5 text-center text-gray-600">{{ $item->quantity }}</td>
                            <td class="px-6 py-5 text-right text-gray-600">{{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-6 py-5 text-right font-bold text-gray-900">{{ number_format($item->amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end">
                <div class="w-full md:w-80 space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-medium text-gray-900">{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-gray-100">
                        <span class="text-lg font-black text-gray-900 uppercase">Total Amount</span>
                        <span class="text-lg font-black text-blue-600">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
