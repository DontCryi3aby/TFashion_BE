<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email:rfc,dns', 'unique:customers,email', 'max:150'],
            'avatar' => ['sometimes', "file", "mimes:jpg,jpeg,png,pdf"],
            'phone_number' => ['required', 'unique:customers,phone_number','numeric', 'digits:10'],
            'address' => ['nullable', 'string', 'max:200'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }
}