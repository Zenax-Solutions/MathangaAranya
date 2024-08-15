<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeechUpdateRequest extends FormRequest
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
            'image' => ['nullable', 'image'],
            'type' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'data' => ['file','max:10024'],
            'publish' => ['required', 'boolean'],
        ];
    }
}
