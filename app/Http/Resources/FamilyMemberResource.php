<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // error maximum stack depth exceeded tambahkan whenLoaded
        return [
             // data yg dipilih dari relasi model headOfFamily dan user utk ditampilkan
            // belongsTo = 'user' => new UserResource($this->user),
            'id' => $this->id,
            // 'head_of_family' => new HeadOfFamilyResource($this->headOfFamily),
            'head_of_family' => new HeadOfFamilyResource($this->whenLoaded('headOfFamily')),
            'user' => new UserResource($this->user),
            'profile_picture' => $this->profile_picture,
            'identity_number' => $this->identity_number,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'occupation' => $this->occupation,
            'marital_status' => $this->marital_status,
            'relation' => $this->relation
        ];
    }
}
