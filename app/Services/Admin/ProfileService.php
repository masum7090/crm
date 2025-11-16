<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function updateProfile(Admin $admin, array $data): void
    {
        if (isset($data['image'])) {
            // Delete old image if exists
            if ($admin->image && Storage::exists($admin->image)) {
                Storage::delete($admin->image);
            }

            // Store new image
            $data['image'] = $data['image']->store('admins', 'public');
        }

        $admin->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'image' => $data['image'] ?? $admin->image,
        ]);
    }

    public function updatePassword(Authenticatable $admin, string $currentPassword, string $newPassword): void
    {
        if (!Hash::check($currentPassword, $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Your current password does not match our records.',
            ]);
        }

        $admin->update([
            'password' => Hash::make($newPassword),
        ]);
    }


}
