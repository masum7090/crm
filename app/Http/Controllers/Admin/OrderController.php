<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;
use App\Mail\InvoiceGenerated;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user', 'invoice')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::whereHas('info')->get(); // Assuming users with info are clients
        $products = Product::where('is_active', true)->get();
        return view('admin.orders.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_type' => 'required|in:product,custom', // Simple way to toggle UI
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = 0;
            $orderItems = [];

            foreach ($validated['items'] as $item) {
                $product = null;
                $description = $item['description'];
                
                if (!empty($item['product_id'])) {
                    $product = Product::find($item['product_id']);
                    if (!$description) {
                        $description = $product->name;
                    }
                }

                $amount = $item['quantity'] * $item['unit_price'];
                $totalAmount += $amount;

                $orderItems[] = [
                    'product_id' => $item['product_id'] ?? null,
                    'description' => $description,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $amount,
                ];
            }

            $order = Order::create([
                'user_id' => $validated['user_id'],
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'currency' => 'USD', // Default
            ]);

            foreach ($orderItems as $itemData) {
                $order->items()->create($itemData);
            }

            // Auto-generate invoice
            $invoice = Invoice::create([
                'order_id' => $order->id,
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                'status' => 'unpaid',
                'issue_date' => now(),
                'due_date' => now()->addDays(14),
                'total_amount' => $order->total_amount,
            ]);

            // Send Emails
            if ($order->user && $order->user->email) {
                try {
                    Mail::to($order->user->email)->send(new OrderCreated($order));
                    Mail::to($order->user->email)->send(new InvoiceGenerated($invoice));
                } catch (\Exception $e) {
                    // Log error but continue
                }
            }

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create order: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('items.product', 'user', 'invoice');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if ($order->status == 'completed' || ($order->invoice && $order->invoice->status == 'paid')) {
            return back()->with('error', 'Cannot edit completed orders or orders with paid invoices.');
        }

        $clients = User::whereHas('info')->get();
        $products = Product::where('is_active', true)->get();
        $order->load('items');
        
        return view('admin.orders.edit', compact('order', 'clients', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if ($order->status == 'completed' || ($order->invoice && $order->invoice->status == 'paid')) {
            return back()->with('error', 'Cannot edit completed orders or orders with paid invoices.');
        }

        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        DB::beginTransaction();
        try {
            // Delete existing items
            $order->items()->delete();

            $totalAmount = 0;
            $orderItems = [];

            foreach ($validated['items'] as $item) {
                $description = $item['description'];
                if (!empty($item['product_id']) && empty($description)) {
                    $product = Product::find($item['product_id']);
                    $description = $product->name;
                }

                $amount = $item['quantity'] * $item['unit_price'];
                $totalAmount += $amount;

                $orderItems[] = [
                    'product_id' => $item['product_id'] ?? null,
                    'description' => $description,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'amount' => $amount,
                ];
            }

            // Update Order
            $order->update([
                'total_amount' => $totalAmount,
                'status' => $validated['status'],
            ]);

            // Re-create items
            foreach ($orderItems as $itemData) {
                $order->items()->create($itemData);
            }

            // If invoice exists, update its amount to match
            if ($order->invoice && $order->invoice->status != 'paid') {
                $order->invoice->update(['total_amount' => $totalAmount]);
            } elseif (!$order->invoice) {
                // Should not happen if auto-generated on create, but good fallback for old orders
                $invoice = Invoice::create([
                    'order_id' => $order->id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                    'status' => 'unpaid',
                    'issue_date' => now(),
                    'due_date' => now()->addDays(14),
                    'total_amount' => $totalAmount,
                ]);
                
                if ($order->user && $order->user->email) {
                    try {
                        Mail::to($order->user->email)->send(new InvoiceGenerated($invoice));
                    } catch (\Exception $e) {}
                }
            }

            DB::commit();
            return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update order: ' . $e->getMessage())->withInput();
        }
    }

    public function generateInvoice(Order $order)
    {
        if ($order->invoice) {
            return back()->with('warning', 'Invoice already exists for this order.');
        }

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)), // Simple generator
            'status' => 'unpaid',
            'issue_date' => now(),
            'due_date' => now()->addDays(14), // Default 14 days
            'total_amount' => $order->total_amount,
        ]);

        // Send Email
        if ($order->user && $order->user->email) {
            try {
                Mail::to($order->user->email)->send(new InvoiceGenerated($invoice));
            } catch (\Exception $e) {
                // Log error but continue
            }
        }

        return back()->with('success', 'Invoice generated successfully: ' . $invoice->invoice_number);
    }
}
