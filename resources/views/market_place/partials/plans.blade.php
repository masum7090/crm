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
            <h2 class="text-3xl font-semibold mb-4">Choose Plan</h2>

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

                <button onclick="openCheckoutModal(1)"
                   class="mt-6 block w-full text-center bg-[#006CBE] text-white font-medium py-3 rounded-xl hover:bg-[#005BA2]">
                    Continue to checkout
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Checkout Modal -->
<div id="checkoutModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto relative">
            <button onclick="closeCheckoutModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div id="checkoutContent" class="p-8">
                <div class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-4 text-gray-600">Loading checkout...</p>
                </div>
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

    // Modal Functions
    let selectedProductId = null;
    
    function openCheckoutModal(productId) {
        selectedProductId = productId;
        const modal = document.getElementById('checkoutModal');
        const content = document.getElementById('checkoutContent');
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Show billing cycle selection
        content.innerHTML = `
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-2">Choose Your Billing Cycle</h2>
                <p class="text-gray-600 text-center mb-8">Select how often you'd like to be billed</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Monthly Plan -->
                    <div onclick="selectBillingCycle('monthly')" class="border-2 border-gray-200 rounded-2xl p-8 hover:border-blue-500 hover:shadow-lg transition-all cursor-pointer group">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold">Monthly</h3>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-hover:border-blue-500 flex items-center justify-center">
                                <div class="w-3 h-3 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100"></div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Pay month-to-month with flexibility to cancel anytime</p>
                        <div class="text-3xl font-bold text-blue-600">Standard Rate</div>
                        <p class="text-sm text-gray-500 mt-2">Billed monthly</p>
                    </div>
                    
                    <!-- Yearly Plan -->
                    <div onclick="selectBillingCycle('yearly')" class="border-2 border-blue-500 bg-blue-50 rounded-2xl p-8 hover:shadow-lg transition-all cursor-pointer group relative">
                        <div class="absolute -top-3 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                            SAVE 20%
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold">Yearly</h3>
                            <div class="w-6 h-6 rounded-full border-2 border-blue-500 flex items-center justify-center">
                                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Best value! Save money with annual billing</p>
                        <div class="text-3xl font-bold text-blue-600">20% Off</div>
                        <p class="text-sm text-gray-500 mt-2">Billed annually</p>
                        <div class="mt-4 bg-white rounded-lg p-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">You save:</span>
                                <span class="font-bold text-green-600">2 months FREE</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        30-day money-back guarantee on all plans
                    </p>
                </div>
            </div>
        `;
    }

    function selectBillingCycle(cycle) {
        const content = document.getElementById('checkoutContent');
        
        // Show loading
        content.innerHTML = `
            <div class="text-center py-8">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-4 text-gray-600">Loading checkout...</p>
            </div>
        `;
        
        // Load checkout form via AJAX with billing cycle
        fetch(`/checkout-page?product_id=${selectedProductId}&billing_cycle=${cycle}`)
            .then(response => response.text())
            .then(html => {
                // Extract just the form content from the full page
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const formContent = doc.querySelector('form');
                
                if (formContent) {
                    // Add billing cycle info to the form
                    const billingInfo = document.createElement('div');
                    billingInfo.className = 'mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200';
                    billingInfo.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-blue-900">Billing Cycle: ${cycle === 'yearly' ? 'Annual (Save 20%)' : 'Monthly'}</p>
                                <p class="text-sm text-blue-700">${cycle === 'yearly' ? 'Billed once per year' : 'Billed monthly'}</p>
                            </div>
                            <button type="button" onclick="openCheckoutModal(${selectedProductId})" class="text-blue-600 text-sm underline hover:text-blue-800">
                                Change
                            </button>
                        </div>
                    `;
                    
                    // Add hidden input for billing cycle
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'billing_cycle';
                    hiddenInput.value = cycle;
                    formContent.appendChild(hiddenInput);
                    
                    content.innerHTML = '';
                    content.appendChild(billingInfo);
                    content.appendChild(formContent);
                } else {
                    content.innerHTML = '<p class="text-red-600 text-center">Error loading checkout form.</p>';
                }
            })
            .catch(error => {
                content.innerHTML = '<p class="text-red-600 text-center">Error loading checkout form.</p>';
                console.error('Error:', error);
            });
    }

    function closeCheckoutModal() {
        const modal = document.getElementById('checkoutModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal on outside click
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('checkoutModal');
        if (event.target === modal) {
            closeCheckoutModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeCheckoutModal();
        }
    });
</script>

</body>
</html>
