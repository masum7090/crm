<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries=Country::all();
        return view('auth.register',compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        UserInfo::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'country_id' => $request->country_id,
            'state_region' => $request->state,
            'postcode' => $request->postcode,
            'currency' => $request->currency,
        ]);
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
