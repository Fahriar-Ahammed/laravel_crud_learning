<?php

namespace App\Http\Requests\Api\Note;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
            'title' => 'string|max:255',
            'desc' => 'nullable|string',
            'date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ];
    }
}
