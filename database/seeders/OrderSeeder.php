<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('email', '!=', 'masum@gmail.com')->get();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) return;

        foreach ($users as $user) {
            // Create 1-2 orders per user
            $orderCount = rand(1, 2);
            for ($i = 0; $i < $orderCount; $i++) {
                $product = $products->random();
                $isPaid = rand(0, 1);
                
                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => $isPaid ? 'completed' : 'pending',
                    'total_amount' => $product->price,
                    'order_date' => now()->subDays(rand(1, 30)),
                ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'description' => $product->name,
                    'quantity' => 1,
                    'unit_price' => $product->price,
                    'amount' => $product->price,
                ]);

                Invoice::create([
                    'order_id' => $order->id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                    'issue_date' => $order->order_date,
                    'due_date' => $order->order_date->addDays(7),
                    'total_amount' => $order->total_amount,
                    'status' => $isPaid ? 'paid' : 'unpaid',
                ]);
            }
        }
    }
}
