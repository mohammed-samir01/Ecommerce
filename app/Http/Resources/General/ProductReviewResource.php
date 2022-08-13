<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'name'          => $this->product->name,
            'User_name'     => $this->name,
            'email'         => $this->email,
            'title'         => $this->title,
            'message'       => $this->message,
            'status'        => $this->status,
            'rating'        => $this->rating,
            'user_image'    => $this->userImage,
            'creates-at'    => $this->created_at->format('d M Y'),
        ];
    }
}
