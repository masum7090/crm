<x-admin-layout>
    <x-page-header title="Mail Settings" description="Manage your application's email configuration." :breadcrumbs="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Mail Settings']]" />

    <div class="bg-white rounded-xl shadow-sm p-8 mt-6">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.mail.update') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-input label="Mailer" name="mail_mailer" :value="$settings->mail_mailer ?? ''" placeholder="smtp" />

                <x-input label="Host" name="mail_host" :value="$settings->mail_host ?? ''" placeholder="smtp.gmail.com" />

                <x-input label="Port" name="mail_port" type="number" :value="$settings->mail_port ?? ''" placeholder="587" />

                <x-input label="Encryption" name="mail_encryption" :value="$settings->mail_encryption ?? ''" placeholder="tls / ssl" />

                <x-input label="Username" name="mail_username" :value="$settings->mail_username ?? ''" placeholder="example@gmail.com" />

                <x-input label="Password" name="mail_password" type="password" :value="$settings->mail_password ?? ''"
                    placeholder="Your App Password" />

                <x-input label="From Address" name="mail_from_address" type="email" :value="$settings->mail_from_address ?? ''"
                    placeholder="noreply@example.com" />

                <x-input label="From Name" name="mail_from_name" :value="$settings->mail_from_name ?? ''" placeholder="Your App Name" />
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    Save Settings
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-8 mt-10">
        <h3 class="text-lg font-semibold mb-6 text-gray-800">Send Test Email</h3>

        @if (session('test_success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg">
                {{ session('test_success') }}
            </div>
        @endif

        @if (session('test_error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
                {{ session('test_error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.mail.test') }}" class="space-y-6">
            @csrf

            <x-input label="Recipient Email" name="test_email" type="email"
                placeholder="Enter an email to test sending" />

            <x-input label="Subject" name="test_subject" placeholder="Test Mail Subject" />

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                <textarea name="test_message" rows="4"
                    class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
                    placeholder="This is a test message from your Mail Settings."></textarea>
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Send Test Mail
            </button>
        </form>
    </div>
</x-admin-layout>
