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
            'product_type' => ['sometimes', 'nullable', 'string', 'max:100'],
            'body_html' => ['sometimes', 'string'],
            'vendor' => ['sometimes', 'nullable', 'string', 'max:255'],
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
                'quantity' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
                'discount' => ['sometimes', 'nullable', 'numeric'],
            ], $shopify);
        }

        return array_merge([
            'title' => ['sometimes', 'string', 'max:255'],
            'quantity' => ['sometimes', 'numeric'],
            'price' => ['sometimes', 'numeric'],
            'discount' => ['sometimes', 'nullable', 'numeric'],
        ], $shopify);
    }
}
