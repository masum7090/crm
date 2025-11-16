<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
        $this->google2fa->setWindow(4);
    }

    public function enable()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->google2fa_enabled) {
            return redirect()->route('admin.dashboard')->with('error', '2FA is already enabled.');
        }

        $secret = $this->google2fa->generateSecretKey();
        session(['google2fa_secret_temp' => $secret]);

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(config('app.name'), $admin->email, $secret);

        // Generate QR Code as SVG
        $renderer = new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd());
        $writer = new Writer($renderer);
        $qrCodeImageUrl = $writer->writeString($qrCodeUrl);

        $recoveryCodes = $this->generateRecoveryCodes();
        session(['recovery_codes_temp' => $recoveryCodes]);

        return view('admin.2fa.enable', compact('qrCodeImageUrl', 'secret', 'recoveryCodes'));
    }

    // STEP 2: Confirm setup
    public function confirm(Request $request)
    {
        $request->validate(['one_time_password' => 'required|numeric']);

        $admin = Auth::guard('admin')->user();
        $secret = session('google2fa_secret_temp');

        \Log::info('2FA Debug', [
            'secret' => $secret,
            'code_entered' => $request->one_time_password,
            'current_timestamp' => $this->google2fa->getCurrentOtp($secret),
            'server_time' => now()->toDateTimeString(),
        ]);

        if ($this->google2fa->verifyKey($secret, $request->one_time_password)) {
            $admin->google2fa_secret = encrypt($secret);
            $admin->google2fa_enabled = true;
            $admin->recovery_codes = encrypt(json_encode(session('recovery_codes_temp')));
            $admin->save();

            session()->forget(['google2fa_secret_temp', 'recovery_codes_temp']);
            session(['google2fa_verified' => true]);

            return redirect()->route('admin.dashboard')->with('success', 'Two-Factor Authentication enabled!');
        }

        return back()->withErrors(['one_time_password' => 'Invalid verification code.']);
    }

    // STEP 3: Verify after login
    public function showVerify()
    {
        return view('admin.2fa.verify');
    }

    public function verify(Request $request)
    {
        $request->validate(['one_time_password' => 'required']);

        $admin = Auth::guard('admin')->user();
        $secret = decrypt($admin->google2fa_secret);
        $valid = $this->google2fa->verifyKey($secret, $request->one_time_password);

        if (!$valid) {
            $recoveryCodes = json_decode(decrypt($admin->recovery_codes), true);

            if (in_array($request->one_time_password, $recoveryCodes)) {
                $recoveryCodes = array_diff($recoveryCodes, [$request->one_time_password]);
                $admin->recovery_codes = encrypt(json_encode(array_values($recoveryCodes)));
                $admin->save();
                $valid = true;
            }
        }

        if ($valid) {
            session(['google2fa_verified' => true]);
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['one_time_password' => 'Invalid verification code.']);
    }

    // STEP 4: Disable 2FA
    public function disable(Request $request)
    {
        $request->validate(['password' => 'required']);
        $admin = Auth::guard('admin')->user();

        if (!Auth::guard('admin')->validate(['email' => $admin->email, 'password' => $request->password])) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $admin->update([
            'google2fa_secret' => null,
            'google2fa_enabled' => false,
            'recovery_codes' => null,
        ]);

        session()->forget('google2fa_verified');

        return redirect()->route('admin.dashboard')->with('success', '2FA disabled successfully.');
    }

    // Generate Recovery Codes
    private function generateRecoveryCodes($count = 8)
    {
        return collect(range(1, $count))->map(fn() => strtoupper(Str::random(4) . '-' . Str::random(4)))->toArray();
    }
}
