<?php

namespace App\Http\Resources\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => Category::find($this->category_id)->name,
            'title' => $this->title,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'galleries' => GalleryResource::collection($this->whenLoaded('galleries'))
        ];
    }
}