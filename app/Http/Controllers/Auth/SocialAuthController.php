<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    // Redirect user to Google for login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            DB::beginTransaction();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(12)),
                    'email_verified_at' => now(),
                ]);

                // Create user info record
                UserInfo::create([
                    'user_id'       => $user->id,
                    'phone'         => null,
                    'company_name'  => null, // Google workspace domain (if available)
                    'address1'      => null,
                    'address2'      => null,
                    'city'          => null,
                    'state_region'  => null,
                    'postcode'      => null,
                    'country_id'       => null,
                    'language'      => 'en',
                    'status'        => 'Active',
                    'client_group'  => null,
                    'payment_method'=> null,
                    'billing_contact'=> null,
                    'currency'      => 'USD',
                    'is_new_user'   => true,
                    'admin_notes'   => 'Auto-created via Google Login',
                    // Default checkbox-like fields:
                    'general_emails'        => true,
                    'invoice_emails'        => true,
                    'support_emails'        => true,
                    'product_emails'        => true,
                    'domain_emails'         => true,
                    'affiliate_emails'      => false,
                    'late_fees'             => false,
                    'separate_invoices'     => false,
                    'status_update'         => true,
                    'overdue_notices'       => true,
                    'disable_cc_processing' => false,
                    'allow_single_sign_on'  => true,
                    'tax_exempt'            => false,
                    'marketing_emails_optin'=> true,
                ]);
            }

            DB::commit();

            // Log user in
            Auth::login($user);

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/login')->withErrors(['google_error' => 'Google login failed: ' . $e->getMessage()]);
        }
    }
}
