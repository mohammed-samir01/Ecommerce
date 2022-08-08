<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'Product_id'  => $this->id,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'description'  => $this->description,
            'price'  => $this->price,
            'quantity'  => $this->quantity,
            'product_category_id'  => $this->product_category_id,
            'featured'  => $this->featured,
            'status'  => $this->status,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'first_media'  => $this->first_media,
         ];
    }
}
