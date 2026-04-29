<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
            'product_type' => ['sometimes', 'nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'body_html' => ['required', 'string'],
            'handle' => ['sometimes', 'nullable', 'string', 'max:255', 'unique:products,handle'],
            'status' => ['sometimes', 'string', 'in:draft,active,archived'],
            'published_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
