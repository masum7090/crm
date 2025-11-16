<?php

namespace App\Helpers;

use App\Models\MailSettings;
use Illuminate\Support\Facades\Config;
use App\Models\MailSetting;

class MailConfigHelper
{
    public static function setMailConfig()
    {
        $mail = MailSettings::first();

        if ($mail) {
            $config = [
                'driver' => $mail->mail_mailer,
                'host' => $mail->mail_host,
                'port' => $mail->mail_port,
                'username' => $mail->mail_username,
                'password' => $mail->mail_password,
                'encryption' => $mail->mail_encryption,
                'from' => [
                    'address' => $mail->mail_from_address,
                    'name' => $mail->mail_from_name,
                ],
            ];

            Config::set('mail.mailers.smtp', [
                'transport' => $mail->mail_mailer,
                'host' => $mail->mail_host,
                'port' => $mail->mail_port,
                'encryption' => $mail->mail_encryption,
                'username' => $mail->mail_username,
                'password' => $mail->mail_password,
            ]);

            Config::set('mail.from', [
                'address' => $mail->mail_from_address,
                'name' => $mail->mail_from_name,
            ]);
        }
    }
}
