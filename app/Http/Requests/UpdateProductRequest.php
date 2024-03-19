<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method();
        if($method == "PUT") {
            return [
                'category_id' => ["required", "exists:categories,id"],
                'title' => ["required", "string", "max:255"],
                'description' => ["required", "string"],
                'quantity' => ["required", "numeric"],
                'price' => ["required", "numeric"],
                'discount' => ["sometimes", "numeric"]
            ];
        } else {
            return [
                'category_id' => ["sometimes", "exists:categories,id"],
                'title' => ["sometimes", "string", "max:255"],
                'description' => ["sometimes", "string"],
                'quantity' => ["sometimes", "numeric"],
                'price' => ["sometimes", "numeric"],
                'discount' => ["sometimes", "numeric"]
            ];
        }
    }
}