<x-admin-layout>
    <x-page-header title="Order Details #{{ $order->id }}" description="View order details and manage invoice."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Orders', 'url' => route('admin.orders.index')], ['label' => '#' . $order->id]]" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        
        <div class="lg:col-span-2 space-y-6">
            {{-- Items --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Order Items</h3>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="py-2">Item</th>
                            <th class="py-2 text-center">Qty</th>
                            <th class="py-2 text-right">Price</th>
                            <th class="py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-b last:border-0 hover:bg-gray-50">
                                <td class="py-3">
                                    <div class="font-medium text-gray-900">{{ $item->description }}</div>
                                    @if($item->product)
                                        <div class="text-xs text-gray-500">{{ $item->product->name }}</div>
                                    @endif
                                </td>
                                <td class="py-3 text-center">{{ $item->quantity }}</td>
                                <td class="py-3 text-right">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="py-3 text-right font-medium">{{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="py-4 text-right font-semibold text-gray-700">Total</td>
                            <td class="py-4 text-right font-bold text-xl text-gray-900">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            {{-- Client Info --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Client Information</h3>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                        {{ substr($order->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium">{{ $order->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.clients.edit', $order->user->id) }}" class="text-sm text-blue-600 hover:underline">View Client Profile</a>
            </div>

            {{-- Actions --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Actions</h3>

                @if($order->status == 'pending' && (!$order->invoice || $order->invoice->status != 'paid'))
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="block text-center w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700 transition mb-4">
                        Edit Order
                    </a>
                @endif
                
                @if ($order->invoice)
                    <div class="p-4 bg-green-50 text-green-700 rounded-lg mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-medium">Invoice Generated</span>
                        </div>
                        <a href="{{ route('admin.invoices.show', $order->invoice->id) }}" class="mt-2 block text-sm underline hover:no-underline">
                            View Invoice #{{ $order->invoice->invoice_number }}
                        </a>
                    </div>
                @else
                    <form action="{{ route('admin.orders.generate-invoice', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-black text-white py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                            Generate Invoice
                        </button>
                    </form>
                @endif
            </div>
        </div>

    </div>
</x-admin-layout>
