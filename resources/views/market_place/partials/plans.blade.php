<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Cart</title>
</head>

<body class="bg-gray-50 text-gray-800">

<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- CART SECTION -->
        <div class="lg:col-span-2">
            <h2 class="text-3xl font-semibold mb-4">Chose Plan</h2>

            <div class="bg-white shadow rounded-xl p-6 space-y-8" id="cart-container">

                <!-- ITEM 1 -->
                <div class="pb-4 border-b product relative"
                     data-yearly-price="10"
                     data-monthly-price="1">

                    <!-- DELETE BUTTON -->
                    <button class="delete-item absolute right-0 bottom-5 text-red-500 text-xl">🗑️</button>

                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold">.COM Domain</h3>
                            <p class="text-gray-500 text-sm">jgasjjha.com</p>
                        </div>
                        <p class="price-display font-semibold">$10.00</p>
                    </div>

                    <div class="mt-3 flex items-center gap-4">
                        <select class="duration-picker border rounded-lg px-3 py-2">
                            <option value="1y">1 Year</option>
                            <option value="2y">2 Years</option>
                            <option value="3y">3 Years</option>
                            <option value="4y">4 Years</option>
                        </select>
                    </div>

                    <div class="mt-2 text-gray-500 text-sm">
                        Renews at <span class="font-medium">$28.99</span>
                    </div>

                    <div class="mt-1 flex items-center gap-2 text-gray-500 text-sm">
                        <span>🎉</span> <span>1 Year Free</span>
                    </div>
                </div>

                <!-- ITEM 2 -->
                <div class="pb-4 border-b product relative"
                     data-yearly-price="12"
                     data-monthly-price="2">

                    <button class="delete-item absolute right-0 bottom-5 text-red-500 text-xl">🗑️</button>

                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold">Domain Privacy + Protection</h3>
                            <p class="text-gray-500 text-sm">jgasjjha.com</p>
                        </div>
                        <p class="price-display font-semibold">$119.90</p>
                    </div>

                    <div class="mt-3">
                        <select class="duration-picker border rounded-lg px-3 py-2">
                            <option value="1y">1 Year</option>
                            <option value="2y">2 Years</option>
                            <option value="3y">3 Years</option>
                        </select>
                    </div>
                </div>

                <!-- ITEM 3 -->
                <div class="pb-4 product relative"
                     data-yearly-price="59.88"
                     data-monthly-price="6">

                    <button class="delete-item absolute right-0 bottom-5 text-red-500 text-xl">🗑️</button>

                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold">Essential Hosting</h3>
                            <p class="text-gray-500 text-sm">jgasjjha.com</p>
                        </div>
                        <p class="price-display font-semibold">$59.88</p>
                    </div>

                    <div class="mt-3">
                        <select class="duration-picker border rounded-lg px-3 py-2">
                            <option value="1y">1 Year</option>
                            <option value="2y">2 Years</option>
                            <option value="3y">3 Years</option>
                        </select>
                    </div>

                    <div class="mt-2 text-gray-500 text-sm">
                        Renews at <span class="font-medium">$167.88</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- ORDER SUMMARY -->
        <div>
            <h2 class="text-3xl font-semibold mb-4">Order summary</h2>

            <div class="bg-white shadow rounded-xl p-6">
                <p class="text-gray-600 mb-3"><span id="item-count">0</span> items in cart</p>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="subtotal" class="font-medium">$0.00</span>
                    </div>

                    <div class="flex justify-between underline text-gray-700">
                        <span>ICANN Fee</span>
                        <span>$0.80</span>
                    </div>

                    <div class="border-t pt-3 flex justify-between text-lg font-semibold">
                        <span>Today's Total:</span>
                        <span id="order-total">$0.00</span>
                    </div>
                </div>

                <a href="{{ route('checkout-page') }}"
                   class="mt-6 block w-full text-center bg-[#006CBE] text-white font-medium py-3 rounded-xl hover:bg-[#005BA2]">
                    Continue to checkout</a>
            </div>
        </div>

    </div>
</div>


<!-- ============================= -->
<!--     PRICE UPDATE SCRIPT       -->
<!-- ============================= -->

<script>
    document.addEventListener("DOMContentLoaded", () => {

        function calculatePrice(product, duration) {
            const yearly = parseFloat(product.dataset.yearlyPrice);
            const monthly = parseFloat(product.dataset.monthlyPrice);

            if (duration === "1m") return monthly;
            if (duration.endsWith("y")) {
                const years = parseInt(duration);
                return yearly * years;
            }
            return yearly;
        }

        function updateOrderTotal() {
            let subtotal = 0;

            document.querySelectorAll(".product").forEach(product => {
                let price = parseFloat(
                    product.querySelector(".price-display").textContent.replace("$", "")
                );
                subtotal += price;
            });

            document.getElementById("item-count").textContent =
                document.querySelectorAll(".product").length;

            document.getElementById("subtotal").textContent = "$" + subtotal.toFixed(2);

            document.getElementById("order-total").textContent =
                "$" + (subtotal + 0.80).toFixed(2);
        }

        // Change price on duration select
        document.querySelectorAll(".duration-picker").forEach(select => {
            select.addEventListener("change", function () {
                const product = this.closest(".product");
                const duration = this.value;

                const newPrice = calculatePrice(product, duration);
                product.querySelector(".price-display").textContent = "$" + newPrice.toFixed(2);

                updateOrderTotal();
            });
        });

        // DELETE ITEM
        document.querySelectorAll(".delete-item").forEach(btn => {
            btn.addEventListener("click", function () {
                this.closest(".product").remove();
                updateOrderTotal();
            });
        });

        updateOrderTotal();
    });
</script>

</body>
</html>
