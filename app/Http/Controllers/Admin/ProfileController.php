<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Services\Admin\ProfileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $admin = Auth::guard('admin')->user();

        $this->profileService->updateProfile($admin, $request->validated());

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $admin = Auth::guard('admin')->user();

        $this->profileService->updatePassword(
            $admin,
            $request->input('current_password'),
            $request->input('password')
        );

        return back()->with('success', 'Password updated successfully!');
    }
}
