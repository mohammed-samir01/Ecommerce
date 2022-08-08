<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'Product_name'  => $this->product->name,
            'User_name'     => $this->name,
            'email'         => $this->email,
            'title'         => $this->title,
            'message'       => $this->message,
            'status'        => $this->status,
            'rating'        => $this->rating,
        ];
    }
}
