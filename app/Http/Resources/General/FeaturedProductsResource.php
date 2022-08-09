<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedProductsResource extends JsonResource
{

    public function toArray($request)

    {

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'price'             => $this->price,
            'quantity'          => $this->quantity,
            'product_category'  => new ProductCategoriesResource($this->category),
            'featured'          => $this->featured,
            'status'            => $this->status,
            'first_media'       => $this->firstMedia,
        ];
    }
}
