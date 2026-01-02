@extends('market_place.layouts.base')

@section('content')
<div class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Transfer Your Domain</h1>
            <p class="text-gray-600 text-lg">Bring your domain to PITOR and enjoy premium features and support.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="md:flex">
                <div class="md:w-1/3 bg-blue-600 p-10 text-white">
                    <h3 class="text-2xl font-bold mb-6">Why transfer?</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="p-1 bg-blue-500 rounded-full text-xs">✓</span>
                            <span>Consolidate your domains</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="p-1 bg-blue-500 rounded-full text-xs">✓</span>
                            <span>Premium support 24/7</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="p-1 bg-blue-500 rounded-full text-xs">✓</span>
                            <span>Competitive renewal rates</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="p-1 bg-blue-500 rounded-full text-xs">✓</span>
                            <span>Easy management interface</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-2/3 p-10">
                    <form action="{{ route('domain.transfer.process') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="domain" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Domain Name</label>
                                <input type="text" name="domain" id="domain" placeholder="example.com" required
                                       class="w-full px-6 py-4 rounded-xl border-2 border-gray-100 focus:border-blue-600 focus:outline-none transition-colors text-lg">
                                @error('domain')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="auth_code" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Auth Code (EPP Code)</label>
                                <input type="text" name="auth_code" id="auth_code" placeholder="Enter EPP code from current registrar" required
                                       class="w-full px-6 py-4 rounded-xl border-2 border-gray-100 focus:border-blue-600 focus:outline-none transition-colors text-lg">
                                @error('auth_code')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg hover:shadow-xl transition-all text-lg mb-4">
                                    Start Transfer
                                </button>
                                <p class="text-center text-sm text-gray-500">
                                    Transfer cost: <span class="font-bold text-gray-800">$15.00</span> (includes 1 year extension)
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-16 grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">1</div>
                <h4 class="font-bold mb-2">Unlock Domain</h4>
                <p class="text-sm text-gray-600">Unlock your domain at your current registrar and get the Auth/EPP code.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">2</div>
                <h4 class="font-bold mb-2">Submit Request</h4>
                <p class="text-sm text-gray-600">Enter your domain and Auth code here to start the process.</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">3</div>
                <h4 class="font-bold mb-2">Confirm Email</h4>
                <p class="text-sm text-gray-600">Confirm the transfer through the link sent to your administrative email.</p>
            </div>
        </div>
    </div>
</div>
@endsection
