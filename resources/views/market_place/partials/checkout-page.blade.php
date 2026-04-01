<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Checkout</title>
</head>

<body class="bg-gray-100 text-gray-800">

<form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">

<div class="max-w-7xl mx-auto py-10 px-4 lg:px-0 grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- ============================ -->
    <!--         LEFT SIDE FORM       -->
    <!-- ============================ -->
    <div class="lg:col-span-2 space-y-10">
    
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ $errors->first() }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- CONTACT INFORMATION -->
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold mb-4">Contact Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="first_name" required placeholder="First Name" class="border p-3 rounded-lg w-full" value="{{ old('first_name') }}">
                <input type="text" name="last_name" required placeholder="Last Name" class="border p-3 rounded-lg w-full" value="{{ old('last_name') }}">
            </div>

            <select name="country" class="border p-3 rounded-lg w-full">
                <option value="United States">United States</option>
                <option value="Canada">Canada</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Bangladesh">Bangladesh</option>
            </select>

            <input type="text" name="address" required placeholder="Address" class="border p-3 rounded-lg w-full" value="{{ old('address') }}">
            <input type="text" name="address2" placeholder="Address 2 (optional)" class="border p-3 rounded-lg w-full" value="{{ old('address2') }}">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="city" required placeholder="City" class="border p-3 rounded-lg w-full" value="{{ old('city') }}">
                <input type="text" name="state" placeholder="State/Province" class="border p-3 rounded-lg w-full" value="{{ old('state') }}">
                <input type="text" name="zip" required placeholder="ZIP/Postal Code" class="border p-3 rounded-lg w-full" value="{{ old('zip') }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="email" name="email" required placeholder="Email" class="border p-3 rounded-lg w-full" value="{{ old('email') }}">
                <input type="text" name="phone" required placeholder="Phone" class="border p-3 rounded-lg w-full" value="{{ old('phone') }}">
            </div>

            @if(!auth()->check())
                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-800 mb-2">Create Account</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="password" name="password" required placeholder="Password" class="border p-3 rounded-lg w-full">
                        <input type="password" name="password_confirmation" required placeholder="Confirm Password" class="border p-3 rounded-lg w-full">
                    </div>
                </div>
            @endif

        </div>

    </div>

    <!-- ============================ -->
    <!--       ORDER SUMMARY BOX      -->
    <!-- ============================ -->
    <div>
        <div class="bg-white shadow rounded-xl p-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-xl font-semibold">Order summary</h3>
            </div>

            <p class="text-gray-600 mb-4"><span class="font-medium">1</span> item in cart</p>

            <div class="space-y-3 text-sm">
                 @if($product)
                    <div class="flex justify-between">
                        <span class="font-medium">{{ $product->name }}</span>
                        <span>${{ number_format($product->price, 2) }}</span>
                    </div>
                @else
                    <div class="flex justify-between">
                        <span>No items selected</span>
                        <span>$0.00</span>
                    </div>
                @endif
                
                <div class="border-t pt-3 flex justify-between text-lg font-semibold">
                    <span>Today's Total:</span>
                    <span>${{ $product ? number_format($product->price, 2) : '0.00' }}</span>
                </div>
            </div>

            <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium text-lg">
                Complete Order
            </button>

            <p class="text-xs text-gray-500 mt-4 leading-5">
                By clicking 'Complete Order', you agree to our terms and privacy policy. An invoice will be generated for you.
            </p>
        </div>
    </div>

</div>
</form>

</body>
</html>
