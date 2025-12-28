<x-admin-layout>
    <x-page-header title="Edit Order #{{ $order->id }}" description="Modify order details."
                   :breadcrumbs="[['label' => 'Home', 'url' => route('admin.dashboard')], ['label' => 'Orders', 'url' => route('admin.orders.index')], ['label' => 'Edit']]" />

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

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                    <input type="text" value="{{ $order->user->name }} ({{ $order->user->email }})" disabled class="w-full bg-gray-100 border-gray-300 rounded-lg shadow-sm text-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>

            {{-- We assume mostly one type of order for simplicity in UI, but handle both --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Order Type</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="order_type" value="product" {{ $order->items->first() && $order->items->first()->product_id ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500" onchange="toggleOrderType('product')">
                        <span class="ml-2">Existing Product</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="order_type" value="custom" {{ $order->items->first() && !$order->items->first()->product_id ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500" onchange="toggleOrderType('custom')">
                        <span class="ml-2">Custom Item</span>
                    </label>
                </div>
            </div>

            <div id="items-container" class="mb-6">
                <h3 class="text-lg font-medium mb-4">Order Items</h3>
                
                @foreach($order->items as $index => $item)
                <div class="item-row border p-4 rounded-lg mb-4 bg-gray-50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 product-select-container {{ $item->product_id ? '' : 'hidden' }}">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Product</label>
                            <select name="items[{{ $index }}][product_id]" class="w-full border-gray-300 rounded-lg text-sm product-select" onchange="updatePrice(this)">
                                <option value="" data-price="0">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} - ${{ $product->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-6 description-container {{ $item->product_id ? 'hidden' : '' }}">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Description</label>
                            <input type="text" name="items[{{ $index }}][description]" value="{{ $item->description }}" class="w-full border-gray-300 rounded-lg text-sm" placeholder="Item Description">
                        </div>
                        
                        <div class="md:col-span-3">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Quantity</label>
                            <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" class="w-full border-gray-300 rounded-lg text-sm" oninput="calculateTotal()">
                        </div>
                        
                        <div class="md:col-span-3">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Unit Price ($)</label>
                            <input type="number" name="items[{{ $index }}][unit_price]" value="{{ $item->unit_price }}" step="0.01" min="0" class="w-full border-gray-300 rounded-lg text-sm price-input" oninput="calculateTotal()">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Update Order</button>
            </div>
        </form>
    </div>

    <script>
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
        }
    </script>
</x-admin-layout>
