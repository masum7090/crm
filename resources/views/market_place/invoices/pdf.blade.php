<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @page { margin: 0px; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 13px; color: #333; margin: 0; padding: 0; line-height: 1.4; }
        .container { position: relative; padding: 40px; min-height: 1000px; }

        /* Ribbon */
        .ribbon-wrapper { position: absolute; top: 0; right: 0; width: 150px; height: 150px; overflow: hidden; z-index: 10; }
        .ribbon {
            position: relative; top: 35px; right: -45px; width: 220px; padding: 10px 0;
            text-align: center; color: #fff; font-weight: bold; font-size: 18px; text-transform: uppercase;
            transform: rotate(45deg); box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .ribbon.unpaid { background-color: #d9534f; }
        .ribbon.paid { background-color: #5cb85c; }
        .ribbon.cancelled { background-color: #777; }

        /* Header Area */
        .header { margin-bottom: 20px; }
        .logo { font-size: 40px; font-weight: bold; color: #999; }
        .logo span { color: #f0ad4e; }
        .company-location { text-align: right; font-size: 16px; margin-top: -30px; }

        /* Invoice info bar */
        .info-bar { background-color: #f1f1f1; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .info-bar h2 { margin: 0 0 8px 0; font-size: 18px; }
        .info-bar p { margin: 2px 0; font-size: 12px; }

        /* Bill to section */
        .bill-to { margin: 30px 0; }
        .bill-to h3 { margin: 0 0 10px 0; font-size: 14px; border-bottom: 2px solid #333; display: inline-block; padding-bottom: 2px; }
        .bill-to p { margin: 2px 0; }

        /* Tables */
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th { background-color: #e9ecef; border: 1px solid #dee2e6; padding: 8px; text-align: left; font-size: 12px; }
        td { border: 1px solid #dee2e6; padding: 8px; vertical-align: top; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* Totals Area */
        .totals-table { width: 40%; float: right; margin-top: 0; }
        .totals-table td { border: none; padding: 4px 8px; font-weight: bold; }
        .totals-table .label { text-align: right; font-weight: normal; }
        .totals-table .row-shaded { background-color: #f8f9fa; }

        /* Transactions */
        .transactions { clear: both; margin-top: 50px; }
        .transactions h3 { font-size: 16px; margin-bottom: 10px; }

        .footer { position: absolute; bottom: 30px; width: 100%; text-align: center; color: #888; font-size: 11px; }

        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>
{{--    <div class="ribbon-wrapper">--}}
{{--        <div class="ribbon {{ $invoice->status }}">{{ $invoice->status }}</div>--}}
{{--    </div>--}}

    <div class="container">
        <div class="header">
            <div class="logo">Pitor</div>
            <div class="company-location">Berlin, Germany</div>
        </div>

        <div class="info-bar">
            <h2>Invoice #{{ $invoice->id }}</h2>
            <p>Invoice Date: {{ $invoice->issue_date->format('l, F jS, Y') }}</p>
            <p>Due Date: {{ $invoice->due_date ? $invoice->due_date->format('l, F jS, Y') : $invoice->issue_date->format('l, F jS, Y') }}</p>
        </div>

        <div class="bill-to">
            <h3>Invoiced To</h3>
            <p>{{ $invoice->order->user->name }}</p>
            <p>ATTN: {{ $invoice->order->user->name }}</p>
            @if($invoice->order->user->info)
                <p>{{ $invoice->order->user->info->company_name ?? 'Individual' }}</p>
                <p>{{ $invoice->order->user->info->address1 }}</p>
                <p>{{ $invoice->order->user->info->city }}, {{ $invoice->order->user->info->zip ?? '' }}</p>
                <p>{{ $invoice->order->user->country->name ?? 'Bangladesh' }}</p>
            @else
                <p>N/A Address</p>
                <p>Bangladesh</p>
            @endif
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 75%;">Description</th>
                    <th style="width: 25%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->order->items as $item)
                    <tr>
                        <td>{{ $item->description ?: ($item->product ? $item->product->name : 'N/A') }} @if($item->product_id) <!-- Optional: Logic for date ranges like in demo --> @endif</td>
                        <td class="text-right">${{ number_format($item->amount, 2) }}USD</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="clearfix">
            <table class="totals-table">
                <tr>
                    <td class="label">Sub Total</td>
                    <td class="text-right">${{ number_format($invoice->total_amount, 2) }}USD</td>
                </tr>
                <tr class="row-shaded">
                    <td class="label">Credit</td>
                    <td class="text-right">$0.00USD</td>
                </tr>
                <tr>
                    <td class="label">Total</td>
                    <td class="text-right">${{ number_format($invoice->total_amount, 2) }}USD</td>
                </tr>
            </table>
        </div>

        <div class="transactions">
            <h3>Transactions</h3>
            <table>
                <thead>
                    <tr>
                        <th class="text-center">Transaction Date</th>
                        <th class="text-center">Gateway</th>
                        <th class="text-center">Transaction ID</th>
                        <th class="text-center">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Assuming no transactions for now as per model --}}
                    <tr>
                        <td colspan="4" class="text-center">No Related Transactions Found</td>
                    </tr>
                    <tr style="background-color: #f8f9fa;">
                        <td colspan="3" class="text-right"><strong>Balance</strong></td>
                        <td class="text-right"><strong>${{ number_format($invoice->total_amount, 2) }}USD</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            PDF Generated on {{ now()->format('l, F jS, Y') }}
        </div>
    </div>
</body>
</html>
