<x-admin-layout>
    <x-page-header
        title="Categories"
        description="Manage product categories and subcategories."
        :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Categories']]"
    />

    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">

        {{-- 🔍 Search Filter --}}
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <x-input name="name" placeholder="Category Name" :value="request('name')" />
            <x-input name="slug" placeholder="Slug" :value="request('slug')" />
            <select name="is_active" class="border-gray-300 rounded-lg text-sm">
                <option value="">Any Status</option>
                <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button class="bg-black text-white px-5 rounded-lg text-sm">Search</button>
        </form>

        <div class="flex justify-between items-center mb-3">
            <h2 class="text-gray-600 text-sm">Manage all categories and subcategories</h2>
            <a href="{{ route('admin.categories.index') }}"
               class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg">
                + Add Category
            </a>
        </div>

        {{-- 🧾 Table --}}
        <table class="w-full text-sm border-collapse">
            <thead>
            <tr class="border-b text-gray-600">
                <th class="py-3 px-2">#</th>
                <th class="py-3 px-2">Name</th>
                <th class="py-3 px-2">Slug</th>
                <th class="py-3 px-2">Parent Category</th>
                <th class="py-3 px-2">Icon</th>
                <th class="py-3 px-2">Status</th>
                <th class="py-3 px-2 text-right">Action</th>
            </tr>
            </thead>

            <tbody class="text-gray-800">
            @foreach ($categories as $category)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-2">{{ $category->id }}</td>
                    <td class="py-3 px-2 font-semibold">{{ $category->name }}</td>
                    <td class="py-3 px-2">{{ $category->slug }}</td>
                    <td class="py-3 px-2">
                        {{ $category->parent ? $category->parent->name : '-' }}
                    </td>
                    <td class="py-3 px-2">
                        @if($category->icon)
                            <img src="{{ $category->icon }}" class="w-6 h-6 rounded shadow" />
                        @else
                            <span class="text-gray-400 text-xs">No icon</span>
                        @endif
                    </td>
                    <td class="py-3 px-2">
                        @if ($category->is_active)
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">ACTIVE</span>
                        @else
                            <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">INACTIVE</span>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-right">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{-- {{ $categories->links() }} --}}
        </div>
    </div>
</x-admin-layout>
