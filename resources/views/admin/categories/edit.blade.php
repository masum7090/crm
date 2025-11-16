<x-admin-layout>
    <x-page-header
        :title="$category ? 'Edit Category' : 'Add Category'"
        description="Edit or update category details."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Categories', 'url' => route('admin.categories.index')],
            ['label' => $category ? 'Edit' : 'Add']
        ]"
    />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ $category ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
            class="space-y-8"
        >
            @csrf
            @if ($category)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-input label="Category Name" name="name"
                         :value="old('name', $category->name ?? '')" placeholder="Hosting" />

                <x-input label="Slug" name="slug"
                         :value="old('slug', $category->slug ?? '')" placeholder="hosting" />

                <div>
                    <label class="text-sm font-semibold text-gray-700">Parent Category</label>
                    <select name="parent_id" class="w-full border-gray-300 rounded-lg text-sm mt-1">
                        <option value="">— None (Main Category) —</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <x-input label="Icon (URL or Path)" name="icon"
                         :value="old('icon', $category->icon ?? '')" placeholder="/icons/hosting.png" />

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Description</label>
                    <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg text-sm mt-1"
                              placeholder="Describe this category...">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        {{ old('is_active', $category->is_active ?? false) ? 'checked' : '' }}>
                    <label class="text-sm font-semibold text-gray-700">Active</label>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    {{ $category ? 'Update Category' : 'Save Category' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
