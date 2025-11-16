<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'unique:admins,email,' . auth('admin')->id()],
            'mobile' => ['required', 'string', 'max:15', 'unique:admins,mobile,' . auth('admin')->id()],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
