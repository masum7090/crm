@extends('market_place.layouts.dashboard-base')

@section('dashboard_content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight uppercase">Invoice</h1>
                <p class="text-gray-500 mt-1 font-medium">#{{ $invoice->invoice_number }}</p>
                <div class="mt-4">
                    <span class="px-3 py-1 text-xs font-black rounded-full uppercase tracking-wider
                        {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $invoice->status == 'unpaid' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $invoice->status == 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ $invoice->status }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xl font-black text-gray-900 uppercase tracking-wide">PITOR MARKET</div>
                <div class="text-gray-500 text-sm mt-1 leading-relaxed">
                    123 Business Avenue<br>
                    Silicon Valley, CA 94025<br>
                    United States
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Bill To</h3>
                    <div class="text-gray-900 font-bold text-lg">{{ $invoice->order->user->name }}</div>
                    <div class="text-gray-600 text-sm mt-1 leading-relaxed">
                        {{ $invoice->order->user->email }}<br>
                        @if($invoice->order->user->info)
                            {{ $invoice->order->user->info->company_name }}<br>
                            {{ $invoice->order->user->info->address1 }}<br>
                            {{ $invoice->order->user->info->city }}, {{ $invoice->order->user->info->country_id }}
                        @endif
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <div class="space-y-2">
                        <div>
                            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Issue Date</span>
                            <div class="text-gray-900 font-bold">{{ $invoice->issue_date->format('F d, Y') }}</div>
                        </div>
                        <div>
                            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Due Date</span>
                            <div class="text-gray-900 font-bold">{{ $invoice->due_date ? $invoice->due_date->format('F d, Y') : 'Immediate' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 overflow-hidden mb-10">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-center">Qty</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-right">Price</th>
                            <th class="px-6 py-4 font-bold text-gray-700 uppercase tracking-wider text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($invoice->order->items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-900">{{ $item->description ?: ($item->product ? $item->product->name : 'N/A') }}</div>
                                <div class="text-gray-400 text-xs mt-0.5">Product ID: #{{ $item->product_id ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-5 text-center text-gray-600 font-medium">{{ $item->quantity }}</td>
                            <td class="px-6 py-5 text-right text-gray-600 font-medium">{{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-6 py-5 text-right font-black text-gray-900">{{ number_format($item->amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mb-12">
                <div class="w-full md:w-80 space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-bold text-gray-900">{{ number_format($invoice->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>VAT (0%)</span>
                        <span class="font-bold text-gray-900">0.00</span>
                    </div>
                    <div class="flex justify-between pt-4 border-t-2 border-gray-100">
                        <span class="text-xl font-black text-gray-900 uppercase">Total Payable</span>
                        <span class="text-xl font-black text-blue-600">{{ $invoice->order->currency }} {{ number_format($invoice->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-8 border-t border-gray-100">
                <a href="{{ route('client.invoices.pdf', $invoice->id) }}" class="w-full sm:w-auto px-8 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-black transition-all text-center shadow-lg active:scale-95">
                    Download PDF
                </a>
                
                @if($invoice->status !== 'paid')
                <a href="{{ route('client.invoices.pay', $invoice->id) }}" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all text-center shadow-lg active:scale-95">
                    Pay Now
                </a>
                @endif
                <a href="{{ route('client.invoices.index') }}" class="w-full sm:w-auto px-8 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-all text-center shadow-sm">
                    Back to Invoices
                </a>
            </div>
        </div>
    </div>
@endsection
