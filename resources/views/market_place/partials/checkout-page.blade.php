<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Checkout</title>
</head>

<body class="bg-gray-100 text-gray-800">

<div class="max-w-7xl mx-auto py-10 px-4 lg:px-0 grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- ============================ -->
    <!--         LEFT SIDE FORM       -->
    <!-- ============================ -->
    <div class="lg:col-span-2 space-y-10">

        <!-- CONTACT INFORMATION -->
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold mb-4">Contact Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" placeholder="First Name" class="border p-3 rounded-lg w-full">
                <input type="text" placeholder="Last Name" class="border p-3 rounded-lg w-full">
            </div>

            <select class="border p-3 rounded-lg w-full">
                <option>United States</option>
                <option>Canada</option>
                <option>United Kingdom</option>
                <option>Bangladesh</option>
            </select>

            <input type="text" placeholder="Address" class="border p-3 rounded-lg w-full">
            <input type="text" placeholder="Address 2 (optional)" class="border p-3 rounded-lg w-full">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" placeholder="City" class="border p-3 rounded-lg w-full">
                <select class="border p-3 rounded-lg w-full">
                    <option>State/Province</option>
                </select>
                <input type="text" placeholder="ZIP/Postal Code" class="border p-3 rounded-lg w-full">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="email" placeholder="Email" class="border p-3 rounded-lg w-full">
                <input type="text" placeholder="Phone" class="border p-3 rounded-lg w-full">
            </div>

            <label class="flex items-start gap-3 mt-2 cursor-pointer">
                <input type="checkbox" class="mt-1">
                <span class="text-sm text-gray-700">
                    YES, I want to hear more about networks, offers and promotions.
                </span>
            </label>

        </div>


        <!-- ACCOUNT INFORMATION -->
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold mb-4">Account Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="password" placeholder="Password" class="border p-3 rounded-lg w-full">
                <input type="password" placeholder="Confirm Password" class="border p-3 rounded-lg w-full">
            </div>

            <a href="{{ route('google.login') }}" class="w-full border p-3 rounded-lg flex justify-center items-center gap-3 mt-3">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5"> Connect with Google
            </a>

            <button class="w-full border p-3 rounded-lg flex justify-center items-center gap-3">
                <img src="https://www.svgrepo.com/show/303128/apple-logo.svg" class="w-5"> Connect with Apple
            </button>
        </div>


        <!-- BILLING INFORMATION -->
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold mb-4">Billing Information</h2>

            <p class="text-sm text-gray-600 mb-2">
                Prepaid Credit Cards or Virtual Cards are not accepted.
            </p>

            <!-- PAYMENT OPTIONS -->
            <div class="flex gap-4">
                <img src="https://www.svgrepo.com/show/508698/credit-card.svg" class="w-14 cursor-pointer p-2 border rounded-lg">
                <img src="https://www.svgrepo.com/show/349378/google-pay.svg" class="w-14 cursor-pointer p-2 border rounded-lg">
                <img src="https://www.svgrepo.com/show/349448/paypal.svg" class="w-14 cursor-pointer p-2 border rounded-lg">
            </div>

            <!-- CARD FIELDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <input type="text" placeholder="Card Number" class="border p-3 rounded-lg w-full">
                <input type="text" placeholder="MM/YY" class="border p-3 rounded-lg w-full">
                <input type="text" placeholder="CVV" class="border p-3 rounded-lg w-full">
            </div>

        </div>


        <!-- BILLING ADDRESS -->
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h2 class="text-xl font-semibold mb-4">Billing Address</h2>

            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" checked>
                <span>Same as account information</span>
            </label>
        </div>

    </div>



    <!-- ============================ -->
    <!--       ORDER SUMMARY BOX      -->
    <!-- ============================ -->
    <div>
        <div class="bg-white shadow rounded-xl p-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-xl font-semibold">Order summary</h3>
                <a href="#" class="text-blue-600 text-sm underline">EDIT CART</a>
            </div>

            <p class="text-gray-600 mb-4"><span class="font-medium">5</span> items in cart</p>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>$149.20</span>
                </div>

                <div class="flex justify-between text-green-600">
                    <span>Total Savings</span>
                    <span>-$89.35</span>
                </div>

                <div class="flex justify-between">
                    <span>Tax</span>
                    <span>$0.00</span>
                </div>

                <div class="flex justify-between underline text-gray-700">
                    <span>ICANN Fee</span>
                    <span>$0.20</span>
                </div>

                <div class="border-t pt-3 flex justify-between text-lg font-semibold">
                    <span>Today's Total:</span>
                    <span>$60.05</span>
                </div>

                <a class="text-sm text-blue-600 underline cursor-pointer">Add Promo Code</a>
            </div>

            <button class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium text-lg">
                Submit payment
            </button>

            <p class="text-xs text-gray-500 mt-4 leading-5">
                By clicking 'Submit Payment', you agree to the terms, automatic renewal policies,
                and acknowledge receipt of our privacy notice.
            </p>
        </div>
    </div>

</div>

</body>
</html>
