<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function handlePreventUpdateField($attribute, $value, $fail, $field) {
        if ($value !== User::find($this->route('customer'))->$field) {
            $fail("You are not allowed to update the $field.");
        }
    }
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
        $method = $this->method();

        if($method == "PUT") {
            return [
                'fullname' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email:rfc,dns',
                function ($attribute, $value, $fail) {
                    if ($value !== User::find($this->route('customer'))->$attribute) {
                        $fail("You are not allowed to update the email.");
                    }
                },
                'unique:customers,email', 'max:150'],
                'avatar' => ['sometimes', "file", "mimes:jpg,jpeg,png"],
                'phone_number' => ['required',
                function ($attribute, $value, $fail) {
                    if ($value !== User::find($this->route('customer'))->$attribute) {
                        $fail("You are not allowed to update the phone number.");
                    }
                }
                ,'unique:customers,phone_number','numeric', 'digits:10'],
                'address' => ['sometimes','nullable', 'string', 'max:200'],
                'role_id' => ['sometimes', 'exists:roles,id'],
            ];
        } else {
            return [
                'fullname' => ['sometimes', 'string', 'max:50'],
                'email' => ['sometimes', 'email:rfc,dns',
                function ($attribute, $value, $fail) {
                    if ($value !== User::find($this->route('customer'))->$attribute) {
                        $fail("You are not allowed to update the email.");
                    }
                },
                'unique:customers,email', 'max:150'],
                'avatar' => ['sometimes', "file", "mimes:jpg,jpeg,png"],
                'phone_number' => ['sometimes',
                function ($attribute, $value, $fail) {
                    if ($value !== User::find($this->route('customer'))->$attribute) {
                        $fail("You are not allowed to update the phone number.");
                    }
                }
                ,'unique:customers,phone_number','numeric', 'digits:10'],
                'address' => ['sometimes','nullable', 'string', 'max:200'],
                'role_id' => ['sometimes', 'exists:roles,id'],
            ];
        }
    }
}