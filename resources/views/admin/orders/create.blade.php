<x-admin-layout>
    <x-page-header title="Create Order" description="Create a new order for a client."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Orders', 'url' => route('admin.orders.index')], ['label' => 'Create']]" />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6 max-w-4xl mx-auto">
        
        @if ($errors->any())
            <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                <select name="user_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select a Client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Order Type</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="order_type" value="product" checked class="text-blue-600 focus:ring-blue-500" onchange="toggleOrderType('product')">
                        <span class="ml-2">Existing Product</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="order_type" value="custom" class="text-blue-600 focus:ring-blue-500" onchange="toggleOrderType('custom')">
                        <span class="ml-2">Custom Item</span>
                    </label>
                </div>
            </div>

            <div id="items-container" class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-800">Order Items</h3>
                    <button type="button" onclick="addItem()" class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors shadow-sm">
                        + Add Item
                    </button>
                </div>
                
                <div id="item-rows-wrapper">
                    <div class="item-row border p-4 rounded-lg mb-4 bg-gray-50 relative group">
                        <button type="button" onclick="removeItem(this)" class="absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 product-select-container">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Product</label>
                                <select name="items[0][product_id]" class="w-full border-gray-300 rounded-lg text-sm product-select" onchange="updatePrice(this)">
                                    <option value="" data-price="0">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - ${{ $product->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <div class="md:col-span-6 description-container hidden">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Description</label>
                                <input type="text" name="items[0][description]" class="w-full border-gray-300 rounded-lg text-sm" placeholder="Item Description">
                            </div>
                            
                            <div class="md:col-span-3">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Quantity</label>
                                <input type="number" name="items[0][quantity]" value="1" min="1" class="w-full border-gray-300 rounded-lg text-sm qty-input" oninput="calculateTotal()">
                            </div>
                            
                            <div class="md:col-span-3">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Unit Price ($)</label>
                                <input type="number" name="items[0][unit_price]" value="0.00" step="0.01" min="0" class="w-full border-gray-300 rounded-lg text-sm price-input" oninput="calculateTotal()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 border-blue-100 border p-4 rounded-xl flex justify-between items-center">
                <span class="font-bold text-blue-800">Total Order Amount:</span>
                <span id="grand-total" class="text-xl font-black text-blue-600">$0.00</span>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.orders.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md transform transition active:scale-95">Create Order</button>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = 1;

        function toggleOrderType(type) {
            const productSelects = document.querySelectorAll('.product-select-container');
            const descriptionContainers = document.querySelectorAll('.description-container');
            
            if (type === 'custom') {
                productSelects.forEach(el => el.classList.add('hidden'));
                descriptionContainers.forEach(el => el.classList.remove('hidden'));
            } else {
                productSelects.forEach(el => el.classList.remove('hidden'));
                descriptionContainers.forEach(el => el.classList.add('hidden'));
            }
        }
        
        function updatePrice(selectInfo) {
            const option = selectInfo.options[selectInfo.selectedIndex];
            const price = option.getAttribute('data-price');
            const row = selectInfo.closest('.item-row');
            const priceInput = row.querySelector('.price-input');
            
            if (price) {
                priceInput.value = price;
            }
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                total += qty * price;
            });
            document.getElementById('grand-total').textContent = '$' + total.toFixed(2);
        }

        function addItem() {
            const wrapper = document.getElementById('item-rows-wrapper');
            const template = wrapper.firstElementChild.cloneNode(true);
            
            // Clean values
            template.querySelector('.product-select').value = "";
            template.querySelector('input[name*="[description]"]').value = "";
            template.querySelector('.qty-input').value = 1;
            template.querySelector('.price-input').value = "0.00";
            
            // Update names
            template.querySelectorAll('[name*="items[0]"]').forEach(input => {
                input.name = input.name.replace('items[0]', `items[${itemIndex}]`);
            });
            
            // Show remove button (always visible in group hover now, but just in case)
            template.querySelector('button').classList.remove('hidden');

            wrapper.appendChild(template);
            itemIndex++;
            calculateTotal();

            // Re-apply current order type visibility
            const currentType = document.querySelector('input[name="order_type"]:checked').value;
            toggleOrderType(currentType);
        }

        function removeItem(btn) {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                btn.closest('.item-row').remove();
                calculateTotal();
            } else {
                alert('At least one item is required.');
            }
        }
    </script>
</x-admin-layout>
