<?php

namespace App\Http\Resources\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'fullname' => $this->fullname,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'avatar' => $this->avatar,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'role' => Role::find($this->role_id)->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}