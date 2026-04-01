@extends('market_place.layouts.base')

@section('content')
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-20 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Premium Web Hosting</h1>
        <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto">
            Speed, security, and reliability for your website. Choose the perfect plan for your needs.
        </p>
    </div>

    {{-- Plans Section --}}
    <div class="container mx-auto px-4 py-16">
        
        @if($groupedPlans->isEmpty())
             <div class="text-center py-10">
                <p class="text-gray-500 text-lg">No hosting plans available at the moment. Please check back later.</p>
             </div>
        @else
            {{-- Tabs/Buttons for Types (if multiple types exist) --}}
            @if($groupedPlans->count() > 1)
                <div class="flex justify-center mb-12 flex-wrap gap-4">
                    @foreach($groupedPlans as $type => $plans)
                        <button onclick="showTab('{{ $type }}')" 
                                id="btn-{{ $type }}"
                                class="tab-btn px-6 py-2 rounded-full border border-blue-600 text-blue-600 font-semibold hover:bg-blue-600 hover:text-white transition-colors uppercase text-sm tracking-wide">
                            {{ $type == 'vps' ? 'VPS' : ucfirst($type) }} Hosting
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- Plans Grid --}}
            @foreach($groupedPlans as $type => $plans)
                <div id="tab-{{ $type }}" class="plan-section {{ !$loop->first ? 'hidden' : '' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                        @foreach($plans as $plan)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300 relative">
                                
                                {{-- Popular Badge illustration --}}
                                @if($loop->iteration == 2 && $plans->count() >= 3) 
                                    <div class="absolute top-0 right-0 bg-yellow-400 text-xs font-bold px-3 py-1 rounded-bl-lg text-white">
                                        POPULAR
                                    </div>
                                @endif

                                <div class="p-8">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $plan->name }}</h3>
                                    <p class="text-gray-500 text-sm mb-6 h-10">{{ $plan->short_description ?? 'Perfect for getting started.' }}</p>
                                    
                                    <div class="flex items-baseline mb-6">
                                        <span class="text-4xl font-extrabold text-gray-900">${{ number_format($plan->price, 2) }}</span>
                                        <span class="text-gray-500 ml-1">/mo</span>
                                    </div>
                                    
                                    @if($plan->sale_price && $plan->sale_price < $plan->price)
                                          <p class="text-sm text-red-500 mb-4 line-through">was ${{ number_format($plan->price * 1.2, 2) }}</p>
                                    @endif

                                    <button onclick="openCheckoutModal({{ $plan->id }})" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl text-center transition-colors">
                                        Get Started
                                    </button>
                                </div>

                                <div class="bg-gray-50 p-8 border-t border-gray-100">
                                    <ul class="space-y-4">
                                        {{-- Dynamic Specs from Meta --}}
                                        <li class="flex items-center text-gray-600 text-sm">
                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span class="font-semibold text-gray-900">{{ $plan->meta['specs']['space'] ?? 'Standard' }}</span> &nbsp;Storage
                                        </li>
                                        <li class="flex items-center text-gray-600 text-sm">
                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span class="font-semibold text-gray-900">{{ $plan->meta['specs']['bandwidth'] ?? 'Standard' }}</span> &nbsp;Bandwidth
                                        </li>
                                        <li class="flex items-center text-gray-600 text-sm">
                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            {{ $plan->meta['specs']['domains'] ?? '1' }} Website(s)
                                        </li>
                                        
                                        @if(($plan->meta['specs']['ssl'] ?? false))
                                            <li class="flex items-center text-gray-600 text-sm">
                                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Free SSL Certificate
                                            </li>
                                        @endif
                                        
                                        @if(($plan->meta['specs']['cpanel'] ?? false))
                                            <li class="flex items-center text-gray-600 text-sm">
                                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                cPanel Control Panel
                                            </li>
                                        @endif
                                        
                                        {{-- Additional generic check --}}
                                        <li class="flex items-center text-gray-600 text-sm">
                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            24/7 Support
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Checkout Modal --}}
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

    {{-- Simple Script for Tabs --}}
    <script>
        function showTab(type) {
            // Hide all sections
            document.querySelectorAll('.plan-section').forEach(el => el.classList.add('hidden'));
            // Remove active style from buttons
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('bg-blue-600', 'text-white');
                el.classList.add('text-blue-600');
            });
            
            // Show selected
            document.getElementById('tab-' + type).classList.remove('hidden');
            // Active Button
            let btn = document.getElementById('btn-' + type);
            if(btn) {
                btn.classList.add('bg-blue-600', 'text-white');
                btn.classList.remove('text-blue-600');
            }
        }
        
        // Init tab based on URL hash or default to first
        document.addEventListener("DOMContentLoaded", function() {
            // Check for hash in URL (e.g., #vps, #shared)
            const hash = window.location.hash.substring(1);
            let activeTabSet = false;

            if (hash) {
                const btn = document.getElementById('btn-' + hash);
                if (btn) {
                    showTab(hash);
                    activeTabSet = true;
                    // Optional: Scroll to section if needed, though browser handles hash jump usually
                    // But since we are showing/hiding, browsing might need help
                    setTimeout(() => {
                        const container = document.querySelector('.container');
                        if(container) container.scrollIntoView({ behavior: 'smooth' });
                    }, 100);
                }
            }

            // If no valid hash or tab not found, set first one active
            if (!activeTabSet) {
                let firstBtn = document.querySelector('.tab-btn');
                if(firstBtn) {
                    firstBtn.classList.add('bg-blue-600', 'text-white');
                    firstBtn.classList.remove('text-blue-600');
                }
            }
        });

        // Store all products data with industry-standard pricing
        const productsData = {
            @foreach($groupedPlans as $type => $plans)
                @foreach($plans as $plan)
                    {{ $plan->id }}: {
                        id: {{ $plan->id }},
                        name: "{{ $plan->name }}",
                        type: "{{ $type }}",
                        // Introductory pricing (first purchase - discounted)
                        introPricing: {
                            '1y': {{ $plan->intro_price_1y ?? $plan->price }},
                            '2y': {{ $plan->intro_price_2y ?? ($plan->price * 2 * 0.9) }},
                            '3y': {{ $plan->intro_price_3y ?? ($plan->price * 3 * 0.85) }},
                            '4y': {{ ($plan->price * 4 * 0.80) }}
                        },
                        // Renewal pricing (regular price after first term)
                        renewalPricing: {
                            '1y': {{ $plan->renewal_price_1y ?? ($plan->price * 1.2) }},
                            '2y': {{ $plan->renewal_price_2y ?? ($plan->price * 2 * 1.15) }},
                            '3y': {{ $plan->renewal_price_3y ?? ($plan->price * 3 * 1.10) }},
                            '4y': {{ ($plan->price * 4 * 1.05) }}
                        },
                        monthlyPrice: {{ $plan->monthly_price ?? ($plan->price / 12) }}
                    },
                @endforeach
            @endforeach
        };

        // Store add-ons data
        const addonsData = [
            @foreach($addons as $addon)
                {
                    id: {{ $addon->id }},
                    name: "{{ $addon->name }}",
                    description: "{{ $addon->description }}",
                    icon: "{{ $addon->icon }}",
                    price: {{ $addon->price }},
                    billingCycle: "{{ $addon->billing_cycle }}",
                    type: "{{ $addon->type }}",
                    isPopular: {{ $addon->is_popular ? 'true' : 'false' }}
                },
            @endforeach
        ];

        // Track selected add-ons
        let selectedAddons = [];

        // Modal Functions
        let selectedProductId = null;
        
        function openCheckoutModal(productId) {
            selectedProductId = productId;
            const product = productsData[productId];
            
            if (!product) {
                alert('Product not found');
                return;
            }
            
            const modal = document.getElementById('checkoutModal');
            const content = document.getElementById('checkoutContent');
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Calculate savings for each term
            const savings = {
                '1y': 0,
                '2y': (product.renewalPricing['2y'] - product.introPricing['2y']).toFixed(2),
                '3y': (product.renewalPricing['3y'] - product.introPricing['3y']).toFixed(2),
                '4y': (product.renewalPricing['4y'] - product.introPricing['4y']).toFixed(2)
            };
            
            // Load the plans page design with actual product data
            content.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- CART SECTION -->
                    <div class="lg:col-span-2">
                        <h2 class="text-3xl font-semibold mb-4">Choose Your Plan</h2>

                        <div class="bg-white shadow rounded-xl p-6 space-y-8" id="cart-container">
                            <!-- Selected Hosting Plan -->
                            <div class="pb-4 border-b product relative" 
                                 data-product-id="${product.id}">
                                <button class="delete-item absolute right-0 bottom-5 text-red-500 text-xl hover:text-red-700">🗑️</button>

                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-semibold">${product.name}</h3>
                                        <p class="text-gray-500 text-sm">${product.type.charAt(0).toUpperCase() + product.type.slice(1)} Hosting</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="price-display font-semibold text-2xl text-blue-600">$${product.introPricing['1y'].toFixed(2)}</p>
                                        <p class="text-xs text-gray-500 line-through">$${product.renewalPricing['1y'].toFixed(2)}</p>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-blue-50 to-green-50 p-4 rounded-lg mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Billing Term:</label>
                                    <select class="duration-picker border-2 border-blue-300 rounded-lg px-4 py-3 w-full font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="1y" data-intro="${product.introPricing['1y']}" data-renewal="${product.renewalPricing['1y']}">
                                            1 Year - $${product.introPricing['1y'].toFixed(2)} (Renews at $${product.renewalPricing['1y'].toFixed(2)})
                                        </option>
                                        <option value="2y" data-intro="${product.introPricing['2y']}" data-renewal="${product.renewalPricing['2y']}">
                                            2 Years - $${product.introPricing['2y'].toFixed(2)} (Save $${savings['2y']}) ⭐
                                        </option>
                                        <option value="3y" data-intro="${product.introPricing['3y']}" data-renewal="${product.renewalPricing['3y']}">
                                            3 Years - $${product.introPricing['3y'].toFixed(2)} (Save $${savings['3y']}) ⭐⭐
                                        </option>
                                        <option value="4y" data-intro="${product.introPricing['4y']}" data-renewal="${product.renewalPricing['4y']}">
                                            4 Years - $${product.introPricing['4y'].toFixed(2)} (Save $${savings['4y']}) ⭐⭐⭐ BEST VALUE
                                        </option>
                                    </select>
                                </div>

                                <div class="renewal-notice bg-yellow-50 border-l-4 border-yellow-400 p-3 text-sm text-yellow-800">
                                    <strong>⚠️ Renewal Notice:</strong> Renews at <span class="renewal-price font-bold">$${product.renewalPricing['1y'].toFixed(2)}</span> after your initial term
                                </div>
                            </div>

                            <!-- ADD-ONS SECTION -->
                            <div class="pt-4">
                                <h3 class="text-2xl font-semibold mb-3">🎁 Enhance Your Hosting</h3>
                                <p class="text-gray-600 text-sm mb-4">Add extra features to supercharge your website</p>
                                
                                <div class="space-y-3" id="addons-container">
                                    ${addonsData.map(addon => `
                                        <div class="addon-item border-2 border-gray-200 rounded-lg p-4 hover:border-blue-400 transition-all ${addon.isPopular ? 'bg-blue-50 border-blue-300' : ''}">
                                            <label class="flex items-start cursor-pointer">
                                                <input type="checkbox" 
                                                       class="addon-checkbox mt-1 w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" 
                                                       data-addon-id="${addon.id}"
                                                       data-addon-price="${addon.price}"
                                                       data-addon-name="${addon.name}">
                                                <div class="ml-3 flex-1">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <span class="text-lg font-semibold">${addon.icon} ${addon.name}</span>
                                                            ${addon.isPopular ? '<span class="ml-2 text-xs bg-orange-500 text-white px-2 py-1 rounded-full">POPULAR</span>' : ''}
                                                        </div>
                                                        <span class="text-blue-600 font-bold">$${addon.price.toFixed(2)}/${addon.billingCycle === 'yearly' ? 'yr' : 'mo'}</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-1">${addon.description}</p>
                                                </div>
                                            </label>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER SUMMARY -->
                    <div>
                        <h2 class="text-3xl font-semibold mb-4">Order Summary</h2>

                        <div class="bg-white shadow rounded-xl p-6">
                            <p class="text-gray-600 mb-3"><span id="item-count">1</span> item in cart</p>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span>Hosting Plan</span>
                                    <span id="subtotal" class="font-medium">$${product.introPricing['1y'].toFixed(2)}</span>
                                </div>

                                <!-- Add-ons List -->
                                <div id="addons-summary" class="space-y-2"></div>

                                <div class="flex justify-between text-green-600 font-medium">
                                    <span>💰 You Save</span>
                                    <span id="savings-display">$0.00</span>
                                </div>

                                <div class="flex justify-between text-gray-600 text-xs">
                                    <span>ICANN Fee</span>
                                    <span>$0.80</span>
                                </div>

                                <div class="border-t-2 border-gray-200 pt-3 flex justify-between text-lg font-bold">
                                    <span>Today's Total:</span>
                                    <span id="order-total" class="text-blue-600">$${(product.introPricing['1y'] + 0.80).toFixed(2)}</span>
                                </div>
                            </div>

                            <button onclick="proceedToCheckout()" class="mt-6 block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 rounded-xl shadow-lg transform transition hover:scale-105">
                                Continue to Checkout →
                            </button>
                            
                            <div class="mt-4 text-center">
                                <p class="text-xs text-gray-500">
                                    <svg class="w-4 h-4 inline text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    30-Day Money-Back Guarantee
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Add event listeners for the dynamically created elements
            setTimeout(() => {
                setupCartListeners();
            }, 100);
        }

        function setupCartListeners() {
            const product = productsData[selectedProductId];
            
            // Change price on duration select
            document.querySelectorAll(".duration-picker").forEach(select => {
                select.addEventListener("change", function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const duration = this.value;
                    const introPrice = parseFloat(selectedOption.dataset.intro);
                    const renewalPrice = parseFloat(selectedOption.dataset.renewal);
                    
                    // Update displayed price
                    document.querySelector(".price-display").textContent = "$" + introPrice.toFixed(2);
                    
                    // Update renewal notice
                    document.querySelector(".renewal-price").textContent = "$" + renewalPrice.toFixed(2);
                    
                    // Calculate and display savings
                    const savings = (renewalPrice - introPrice);
                    document.getElementById("savings-display").textContent = "$" + savings.toFixed(2);
                    
                    updateOrderTotal(introPrice);
                });
            });

            // Handle add-on checkboxes
            document.querySelectorAll(".addon-checkbox").forEach(checkbox => {
                checkbox.addEventListener("change", function () {
                    const addonId = parseInt(this.dataset.addonId);
                    const addonPrice = parseFloat(this.dataset.addonPrice);
                    const addonName = this.dataset.addonName;
                    
                    if (this.checked) {
                        // Add to selected add-ons
                        selectedAddons.push({
                            id: addonId,
                            name: addonName,
                            price: addonPrice
                        });
                    } else {
                        // Remove from selected add-ons
                        selectedAddons = selectedAddons.filter(a => a.id !== addonId);
                    }
                    
                    updateAddonsSummary();
                    updateOrderTotal();
                });
            });

            // DELETE ITEM
            document.querySelectorAll(".delete-item").forEach(btn => {
                btn.addEventListener("click", function () {
                    if (confirm('Remove this item from your cart?')) {
                        closeCheckoutModal();
                    }
                });
            });
        }

        function updateAddonsSummary() {
            const summaryContainer = document.getElementById("addons-summary");
            
            if (selectedAddons.length === 0) {
                summaryContainer.innerHTML = '';
                return;
            }
            
            summaryContainer.innerHTML = selectedAddons.map(addon => `
                <div class="flex justify-between text-gray-700">
                    <span class="text-xs">+ ${addon.name}</span>
                    <span class="text-xs font-medium">$${addon.price.toFixed(2)}</span>
                </div>
            `).join('');
        }

        function updateOrderTotal(hostingPrice = null) {
            if (hostingPrice === null) {
                const priceText = document.querySelector(".price-display")?.textContent || "$0";
                hostingPrice = parseFloat(priceText.replace("$", ""));
            }
            
            // Calculate add-ons total
            const addonsTotal = selectedAddons.reduce((sum, addon) => sum + addon.price, 0);
            
            const icannFee = 0.80;
            const total = hostingPrice + addonsTotal + icannFee;

            document.getElementById("subtotal").textContent = "$" + hostingPrice.toFixed(2);
            document.getElementById("order-total").textContent = "$" + total.toFixed(2);
            
            // Update item count
            const itemCount = 1 + selectedAddons.length;
            document.getElementById("item-count").textContent = itemCount;
        }

        function proceedToCheckout() {
            const content = document.getElementById('checkoutContent');
            
            // Show loading
            content.innerHTML = `
                <div class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-4 text-gray-600">Loading checkout...</p>
                </div>
            `;
            
            // Load checkout form
            fetch(`/checkout-page?product_id=${selectedProductId}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const formContent = doc.querySelector('form');
                    
                    if (formContent) {
                        content.innerHTML = '';
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
@endsection
