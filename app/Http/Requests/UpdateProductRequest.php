<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method();
        $shopify = [
            'vendor_id' => ['sometimes', 'integer', 'exists:vendors,id'],
            'product_type' => ['sometimes', 'nullable', 'string', 'max:100'],
            'body_html' => ['sometimes', 'string'],
            'handle' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products', 'handle')->ignore($this->route('product')),
            ],
            'status' => ['sometimes', 'string', 'in:draft,active,archived'],
            'published_at' => ['sometimes', 'nullable', 'date'],
        ];

        if ($method == 'PUT') {
            return array_merge([
                'title' => ['required', 'string', 'max:255'],
            ], $shopify);
        }

        return array_merge([
            'title' => ['sometimes', 'string', 'max:255'],
        ], $shopify);
    }
}
