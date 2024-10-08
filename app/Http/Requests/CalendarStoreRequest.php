<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarStoreRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'pdf' => ['file', 'required'],
            'publish' => ['required', 'boolean'],
        ];
    }
}
