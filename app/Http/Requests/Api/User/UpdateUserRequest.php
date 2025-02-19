<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $this->route('user'), // Ignore current user's email in unique check
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
        ];
    }
}
