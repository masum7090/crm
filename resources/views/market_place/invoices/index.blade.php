@extends('market_place.layouts.dashboard-base')
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        @include('market_place.partials.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-semibold mb-6">My Invoices</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                        <tr class="border-b text-gray-600 text-left">
                            <th class="py-3 px-2">Invoice #</th>
                            <th class="py-3 px-2">Status</th>
                            <th class="py-3 px-2">Issue Date</th>
                            <th class="py-3 px-2">Due Date</th>
                            <th class="py-3 px-2 text-right">Amount</th>
                            <th class="py-3 px-2 text-right">Action</th>
                        </tr>
                        </thead>

                        <tbody class="text-gray-800">
                        @forelse ($invoices as $invoice)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2 font-medium">{{ $invoice->invoice_number }}</td>
                                <td class="py-3 px-2">
                                     <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $invoice->status == 'unpaid' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $invoice->status == 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-2">{{ $invoice->issue_date->format('M d, Y') }}</td>
                                <td class="py-3 px-2">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '—' }}</td>
                                <td class="py-3 px-2 text-right font-medium">{{ number_format($invoice->total_amount, 2) }}</td>
                                <td class="py-3 px-2 text-right">
                                    <a href="{{ route('client.invoices.show', $invoice->id) }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">
                                    No invoices found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $invoices->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
