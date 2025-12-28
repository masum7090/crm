<x-admin-layout>
    <x-page-header title="Invoice #{{ $invoice->invoice_number }}" description="View invoice details."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Invoices', 'url' => route('admin.invoices.index')], ['label' => '#' . $invoice->invoice_number]]" />

    <div class="max-w-4xl mx-auto mt-6 bg-white border rounded-xl shadow-lg p-10 print:shadow-none print:border-none">

        {{-- Invoice Header --}}
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-1">INVOICE</h1>
                <p class="text-gray-500">#{{ $invoice->invoice_number }}</p>
                <div class="mt-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $invoice->status == 'unpaid' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $invoice->status == 'overdue' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ strtoupper($invoice->status) }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xl font-bold text-gray-900">MyCompany Inc.</div>
                <div class="text-gray-500 text-sm mt-1">
                    123 Business Street<br>
                    New York, NY 10001<br>
                    United States
                </div>
            </div>
        </div>

        {{-- Dates and Addresses --}}
        <div class="flex justify-between mb-10">
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Bill To</h3>
                @if(optional($invoice->order)->user)
                    <div class="font-bold text-gray-900">{{ $invoice->order->user->name }}</div>
                    <div class="text-gray-600 text-sm mt-1">
                        {{ $invoice->order->user->email }}<br>
                        @if($invoice->order->user->info)
                            {{ $invoice->order->user->info->company_name }}<br>
                            {{ $invoice->order->user->info->address1 }}<br>
                            {{ $invoice->order->user->info->city }}, {{ $invoice->order->user->info->country_id }}
                        @endif
                    </div>
                @else
                    <span class="text-gray-400">Guest / Unknown</span>
                @endif
            </div>
            <div class="text-right">
                <div class="mb-2">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Issue Date:</span>
                    <span class="text-gray-900 font-medium ml-2">{{ $invoice->issue_date->format('M d, Y') }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Due Date:</span>
                    <span class="text-gray-900 font-medium ml-2">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '—' }}</span>
                </div>
            </div>
        </div>

        {{-- Line Items --}}
        <table class="w-full mb-10">
            <thead>
                <tr class="border-b-2 border-gray-100">
                    <th class="text-left py-3 text-sm font-semibold text-gray-600 uppercase">Description</th>
                    <th class="text-center py-3 text-sm font-semibold text-gray-600 uppercase">Qty</th>
                    <th class="text-right py-3 text-sm font-semibold text-gray-600 uppercase">Price</th>
                    <th class="text-right py-3 text-sm font-semibold text-gray-600 uppercase">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->order->items as $item)
                    <tr class="border-b border-gray-50">
                        <td class="py-4 text-gray-900">
                            {{ $item->description }}
                        </td>
                        <td class="py-4 text-center text-gray-600">{{ $item->quantity }}</td>
                        <td class="py-4 text-right text-gray-600">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="py-4 text-right text-gray-900 font-medium">{{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Totals --}}
        <div class="flex justify-end">
            <div class="w-1/2">
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-900 font-medium">{{ number_format($invoice->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-100">
                    <span class="text-gray-600">Tax (0%)</span>
                    <span class="text-gray-900 font-medium">$0.00</span>
                </div>
                <div class="flex justify-between py-4">
                    <span class="text-lg font-bold text-gray-900">Total</span>
                    <span class="text-lg font-bold text-blue-600">${{ number_format($invoice->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-12 text-center text-gray-500 text-sm print:hidden flex justify-center gap-4">
            <button onclick="window.print()" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition">
                Print / Download PDF
            </button>
            <form action="{{ route('admin.invoices.update-status', $invoice->id) }}" method="POST" class="inline-flex">
                @csrf
                <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded-lg text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled selected>Mark Status</option>
                    <option value="paid" {{ $invoice->status == 'paid' ? 'disabled' : '' }}>Mark as Paid</option>
                    <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'disabled' : '' }}>Mark as Unpaid</option>
                    <option value="overdue" {{ $invoice->status == 'overdue' ? 'disabled' : '' }}>Mark as Overdue</option>
                </select>
            </form>
        </div>
    </div>
</x-admin-layout>
