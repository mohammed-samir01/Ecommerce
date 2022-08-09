<?php

namespace App\Http\Resources\General;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{

    public function toArray($request)
    {
        return [

                'ProductName'            => $this->name,
                'slug'                  => $this->slug,
                'description'           => $this->description,
                'price'                 => $this->price,
                'quantity'              => $this->quantity,
                'rating'                => $this->reviews,
                'product_category'      => $this->category,
                'featured'              => $this->featured(),
                'status'                => $this->status(),
                'Images'                 => MediaResource::collection($this->media)->first(),
                'review'                => ProductReviewResource::collection($this->reviews),

        ];
    }
}
