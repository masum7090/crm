<x-admin-layout>
    <x-page-header title="Orders" description="Manage customer orders."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Orders']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">All Orders</h2>
            <a href="{{ route('admin.orders.create') }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                + Create Order
            </a>
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
