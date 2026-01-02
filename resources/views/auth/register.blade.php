<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Company Name -->
            <div>
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name')" />
                <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
            </div>

            <!-- Address 1 -->
            <div>
                <x-input-label for="address1" :value="__('Address 1')" />
                <x-text-input id="address1" name="address1" type="text" class="mt-1 block w-full" :value="old('address1')" />
                <x-input-error class="mt-2" :messages="$errors->get('address1')" />
            </div>

            <!-- Address 2 -->
            <div>
                <x-input-label for="address2" :value="__('Address 2')" />
                <x-text-input id="address2" name="address2" type="text" class="mt-1 block w-full" :value="old('address2')" />
                <x-input-error class="mt-2" :messages="$errors->get('address2')" />
            </div>

            <!-- City -->
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city')" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <!-- State/Region -->
            <div>
                <x-input-label for="state" :value="__('State / Region')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state')" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <!-- Postcode -->
            <div>
                <x-input-label for="postcode" :value="__('Postcode')" />
                <x-text-input id="postcode" name="postcode" type="text" class="mt-1 block w-full" :value="old('postcode')" />
                <x-input-error class="mt-2" :messages="$errors->get('postcode')" />
            </div>

            <!-- Country -->
            <div>
                <x-input-label for="country_id" :value="__('Country')" />
                <select id="country_id" name="country_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm py-2">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
