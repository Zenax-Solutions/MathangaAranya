<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationStoreRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'country' =>['required', 'string'],
            'phone_number' =>['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'amount' => ['required'],
            'slip' => ['file', 'required'],
        ];
    }
}
