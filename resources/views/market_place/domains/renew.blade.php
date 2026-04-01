@extends('market_place.layouts.base')

@section('content')
<div class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Renew Your Domain</h1>
            <p class="text-gray-600 text-lg">Keep your online presence active. Enter your domain name to renew.</p>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">
                <form action="{{ route('domain.renew.process') }}" method="POST">
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

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 shadow-lg hover:shadow-xl transition-all text-lg mb-4">
                                Continue to Renewal
                            </button>
                            <p class="text-center text-sm text-gray-500">
                                Renewal cost: <span class="font-bold text-gray-800">$15.00</span> per year
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="mt-12 bg-blue-50 rounded-2xl p-6 border border-blue-100">
                <div class="flex gap-4">
                    <span class="text-2xl">💡</span>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-1">Tip: Enable Auto-Renewal</h4>
                        <p class="text-sm text-blue-700">Don't risk losing your domain. You can enable auto-renewal from your dashboard after the renewal is complete.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
