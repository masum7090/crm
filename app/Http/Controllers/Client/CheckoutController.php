<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
use App\Mail\OrderCreated;
use App\Mail\InvoiceGenerated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = Product::find($request->product_id);
        }

        return view('market_place.partials.checkout-page', compact('product'));
    }

    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
        ];

        // If user is NOT logged in, require unique email and password
        if (!Auth::check()) {
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|confirmed|min:8';
        } else {
            // If logged in, we use their existing email, but we might validate the form email matches or just ignore form email
            // Let's validate strictly just in case, but usually we just use Auth::user()
            $rules['email'] = 'required|email';
        }

        $request->validate($rules);

        $product = Product::findOrFail($request->product_id);

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            // Create new user (Email guaranteed unique by validation)
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'client', 
            ]);
            
            Auth::login($user);
        }

        // 2. Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => $product->price,
            'order_date' => now(),
        ]);

        // 3. Create Order Item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'unit_price' => $product->price,
            'amount' => $product->price,
        ]);

        // 4. Create Invoice
        $invoice = Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'issue_date' => now(),
            'due_date' => now()->addDays(7), // 7 days due
            'total_amount' => $order->total_amount,
            'status' => 'unpaid',
        ]);

        // 5. Send Emails
        try {
            Mail::to($user->email)->send(new OrderCreated($order));
            Mail::to($user->email)->send(new InvoiceGenerated($invoice));
        } catch (\Exception $e) {
            // Log email error but don't stop the flow
            \Log::error('Checkout Email Error: ' . $e->getMessage());
        }

        // 6. Redirect to Invoice Payment
        return redirect()->route('client.invoices.show', $invoice->id)->with('success', 'Order placed successfully! Please complete payment.');
    }
}
