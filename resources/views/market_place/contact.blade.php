@extends('market_place.layouts.base')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-blue-600 py-16 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
        <p class="text-lg opacity-90 max-w-2xl mx-auto px-6">
            Have questions about our hosting services? We're here to help you 24/7.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Contact Info -->
            <div class="space-y-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Offices</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <!-- NY Office -->
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 mb-4 text-2xl">
                                🇺🇸
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">USA Office</h3>
                            <p class="text-gray-600 leading-relaxed italic">
                                1079 E LOVEJOY ST<br>
                                New York, NY 14206<br>
                                United States
                            </p>
                        </div>

                        <!-- Bangladesh Office -->
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-4 text-2xl">
                                🇧🇩
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Bangladesh Office</h3>
                            <p class="text-gray-600 leading-relaxed italic">
                                House No: 12, Road No: 13<br>
                                Khilkhet<br>
                                Dhaka-1229, Bangladesh
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Support Channels -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Get In Touch</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                            <div class="text-3xl mb-2">📧</div>
                            <h4 class="font-bold mb-1">Email</h4>
                            <p class="text-sm text-gray-500">info@pitor.net</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                            <div class="text-3xl mb-2">📞</div>
                            <h4 class="font-bold mb-1">Phone</h4>
                            <p class="text-xs text-gray-500 mb-1">+8801818898189</p>
                            <p class="text-xs text-gray-500">+12129206751</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-colors">
                            <div class="text-3xl mb-2">🕒</div>
                            <h4 class="font-bold mb-1">Hours</h4>
                            <p class="text-sm text-gray-500">Mon - Fri: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Send us a message</h2>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Your Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" placeholder="john@example.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Subject</label>
                        <input type="text" name="subject" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" placeholder="How can we help?">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Message</label>
                        <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all resize-none" placeholder="Write your message here..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Map Section -->
    <div class="max-w-7xl mx-auto px-6 pb-20">
        <div class="h-64 md:h-96 bg-gray-200 rounded-3xl overflow-hidden relative shadow-lg">
             <iframe 
                width="100%" 
                height="100%" 
                frameborder="0" 
                style="border:0;" 
                src="https://www.google.com/maps?q=23.8339161,90.4226343&hl=en&z=18&output=embed" 
                allowfullscreen>
             </iframe>
        </div>
    </div>
</div>
@endsection
