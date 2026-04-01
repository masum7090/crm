@extends('market_place.layouts.base')

@section('content')
    <div class="flex min-h-screen bg-gray-50/50">
        <!-- Sidebar -->
        @include('market_place.partials.sidebar')

        <!-- Dashboard Content -->
        <main class="flex-1 p-4 md:p-8">
            <div class="max-w-7xl mx-auto">
                @yield('dashboard_content')
            </div>
        </main>
    </div>
@endsection
