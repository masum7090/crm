<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailSettings;
use App\Services\Admin\MailSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailSettingController extends Controller
{
    protected $mailService;

    public function __construct(MailSettingService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function index()
    {
        $settings = $this->mailService->getSettings();
        return view('admin.settings.mail_settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|numeric',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'nullable|email',
            'mail_from_name' => 'nullable|string',
        ]);

        $this->mailService->updateSettings($request->all());

        return redirect()->back()->with('success', 'Mail settings updated successfully.');
    }

    public function sendTestMail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
            'test_subject' => 'required|string|max:255',
            'test_message' => 'required|string',
        ]);

        $settings = MailSettings::first(); // assuming your settings are stored in this model

        if (!$settings) {
            return back()->with('test_error', 'Mail settings not configured yet.');
        }

        // Apply mail config dynamically
        $this->mailService->applyMailSettings($settings);

        // Send test mail
        $success = $this->mailService->sendTestMail($request->test_email, $request->test_subject, $request->test_message);

        Log::debug('Active Mail Config:', [
            'default' => config('mail.default'),
            'smtp' => config('mail.mailers.smtp'),
            'from' => config('mail.from'),
        ]);

        if ($success) {
            return back()->with('test_success', '✅ Test mail sent successfully!');
        }

        return back()->with('test_error', '❌ Failed to send test mail. Check your credentials or configuration.');
    }
}
