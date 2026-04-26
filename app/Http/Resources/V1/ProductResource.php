<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_type' => $this->product_type,
            'title' => $this->title,
            'body_html' => $this->body_html,
            'vendor' => $this->vendor,
            'handle' => $this->handle,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'variants' => $this->whenLoaded('variants'),
            'options' => $this->whenLoaded('options'),
            'images' => $this->whenLoaded('images'),
            'collections' => $this->whenLoaded('collections'),
        ];
    }
}
