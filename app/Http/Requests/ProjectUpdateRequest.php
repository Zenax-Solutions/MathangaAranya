<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'feature_image' => ['image', 'required'],
            'title' => ['required', 'string'],
            'short_description' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'date' => ['nullable', 'date'],
            'quantity' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
            'publish' => ['required', 'boolean'],
            'gallery' => ['image', 'nullable'],
        ];
    }
}
