@extends('market_place.layouts.dashboard-base')

@section('dashboard_content')
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Profile Settings</h2>
            
            <div class="max-w-2xl">
                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-50">Personal Information</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-50">Change Password</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
