<?php

namespace App\Services\Admin;

use App\Models\MailSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailSettingService
{
    public function getSettings()
    {
        return MailSettings::first();
    }

    public function updateSettings($data)
    {
        $mail = MailSettings::first() ?? new MailSettings();
        $mail->fill($data);
        $mail->save();

        return $mail;
    }

   public function applySettings()
{
    $mail = \App\Models\MailSettings::first();
    if (!$mail) {
        \Log::error('Mail settings not found');
        return;
    }

    // 🔹 Force Laravel to use the correct mailer
    Config::set('mail.default', $mail->mail_mailer ?? 'smtp');

    // 🔹 Update full SMTP mailer configuration
    Config::set('mail.mailers.smtp', [
        'transport'  => 'smtp',
        'host'       => $mail->mail_host,
        'port'       => $mail->mail_port,
        'encryption' => strtolower($mail->mail_encryption) === 'ssl/tls' ? 'ssl' : strtolower($mail->mail_encryption),
        'username'   => $mail->mail_username,
        'password'   => $mail->mail_password,
        'timeout'    => null,
        'auth_mode'  => null,
    ]);

    // 🔹 Update "From" information
    Config::set('mail.from', [
        'address' => $mail->mail_from_address,
        'name'    => $mail->mail_from_name,
    ]);

    // 🔹 Rebind mailer to use new settings
    app()->forgetInstance('mailer');
    app()->forgetInstance('mail.manager');
    app()->bind('mailer', function ($app) {
        return $app->make(\Illuminate\Mail\Mailer::class);
    });

    Log::debug('✅ Mail settings applied dynamically', [
        'default' => config('mail.default'),
        'smtp'    => config('mail.mailers.smtp'),
        'from'    => config('mail.from'),
    ]);
}

    public function applyMailSettings($settings)
    {
        Config::set('mail.mailers.smtp.transport', 'smtp');
        Config::set('mail.mailers.smtp.host', $settings->mail_host);
        Config::set('mail.mailers.smtp.port', $settings->mail_port);
        Config::set('mail.mailers.smtp.encryption', $settings->mail_encryption);
        Config::set('mail.mailers.smtp.username', $settings->mail_username);
        Config::set('mail.mailers.smtp.password', $settings->mail_password);
        Config::set('mail.from.address', $settings->mail_from_address);
        Config::set('mail.from.name', $settings->mail_from_name);
    }

    public function sendTestMail($email, $subject, $message)
    {
        try {
            Mail::raw($message, function ($mail) use ($email, $subject) {
                $mail->to($email)->subject($subject);
            });
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
