<!DOCTYPE html>
<html>
<head>
    <title>New Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hello {{ $invoice->order->user->name }},</h2>
    <p>A new invoice has been generated for your account.</p>
    
    <h3>Invoice Details</h3>
    <p><strong>Invoice #:</strong> {{ $invoice->invoice_number }}</p>
    <p><strong>Amount Due:</strong> {{ number_format($invoice->total_amount, 2) }}</p>
    <p><strong>Due Date:</strong> {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</p>
    
    <p>We have attached a PDF copy of your invoice to this email.</p>
    
    <p>You can also view and pay this invoice online in your <a href="{{ route('client.invoices.show', $invoice->id) }}">dashboard</a>.</p>
    
    <p>Best regards,<br>MyCompany Team</p>
</body>
</html>
