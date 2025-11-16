@props([
    'title' => 'Dashboard',
    'description' => "Welcome back! Here's what's happening today.",
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Dashboard'],
    ],
])
<nav class="flex items-center gap-2 mb-6 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
    @foreach ($breadcrumbs as $index => $item)
        @if ($index > 0)
            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        @endif

        @if ($loop->last)
            <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $item['label'] }}</span>
        @else
            <a href="{{ $item['url'] ?? '#' }}" class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors flex items-center gap-2">
                @if ($index === 0)
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                @endif
                {{ $item['label'] }}
            </a>
        @endif
    @endforeach
</nav>

<div class="mb-6">
    <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-gray-100">{{ $title }}</h1>
    <p class="text-gray-500 dark:text-gray-400">{{ $description }}</p>
</div>
