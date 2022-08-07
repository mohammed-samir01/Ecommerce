<?php

namespace App\Http\Resources\General;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{

    public function toArray($request)
    {
        return [

                'name'                  => $this->name,
                'slug'                  => $this->slug,
                'description'           => $this->description,
                'price'                 => $this->price,
                'quantity'              => $this->quantity,
                'rating'                => Product::withAvg('reviews', 'rating')->whereSlug($this->slug)->Active()->HasQuantity()->ActiveCategory()->firstOrFail(),
                'product_category'      => new ProductCategoriesResource($this->category),
                'featured'              => $this->featured(),
                'status'                => $this->status(),
                'media'                 => MediaResource::collection($this->media),

        ];
    }
}
