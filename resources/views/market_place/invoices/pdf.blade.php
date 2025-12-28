<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .header { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #333; }
        .company-info { text-align: right; }
        .bill-to { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 8px; background-color: #f2f2f2; border-bottom: 1px solid #ddd; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .total-row td { border-top: 2px solid #333; font-weight: bold; }
        .status { padding: 5px 10px; border-radius: 4px; color: white; display: inline-block; }
        .status.paid { background-color: green; }
        .status.unpaid { background-color: orange; }
        .status.overdue { background-color: red; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div style="width:100%; overflow:hidden;">
            <div style="float:left; width:50%;">
                <h1>INVOICE</h1>
                <p>#{{ $invoice->invoice_number }}</p>
                <div class="status {{ $invoice->status }}">{{ strtoupper($invoice->status) }}</div>
            </div>
            <div style="float:right; width:50%; text-align:right;">
                <strong>MyCompany Inc.</strong><br>
                123 Business Street<br>
                New York, NY 10001
            </div>
        </div>

        <div style="clear:both; margin-top: 40px; margin-bottom: 40px;">
            <div style="float:left; width:50%;">
                <strong>Bill To:</strong><br>
                {{ $invoice->order->user->name }}<br>
                {{ $invoice->order->user->email }}<br>
                @if($invoice->order->user->info)
                    {{ $invoice->order->user->info->company_name }}<br>
                    {{ $invoice->order->user->info->address1 }}
                @endif
            </div>
            <div style="float:right; width:50%; text-align:right;">
                <strong>Issue Date:</strong> {{ $invoice->issue_date->format('M d, Y') }}<br>
                <strong>Due Date:</strong> {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '-' }}
            </div>
        </div>

        <div style="clear:both;"></div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align:center;">Qty</th>
                    <th style="text-align:right;">Price</th>
                    <th style="text-align:right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->order->items as $item)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td style="text-align:center;">{{ $item->quantity }}</td>
                        <td style="text-align:right;">{{ number_format($item->unit_price, 2) }}</td>
                        <td style="text-align:right;">{{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" style="text-align:right;">Total</td>
                    <td style="text-align:right;">{{ number_format($invoice->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
