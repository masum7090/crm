<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $countries=Country::all();
        return view('auth.login',compact('countries'));
    }

    public function adminCreate()
    {
        return view('auth.admin-login');
    }

    public function adminStore(LoginRequest $request)
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput();
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        session()->forget('google2fa_verified');
        return redirect()->route('admin.create');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
