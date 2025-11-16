<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="block text-gray-700 font-semibold mb-2">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full border border-gray-300 focus:border-red-500 focus:ring-1 focus:ring-red-500 rounded-lg px-4 py-2 text-gray-800 bg-white transition'
        ]) }}
    >

    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
