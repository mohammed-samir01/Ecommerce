<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [

                'name'                  => $this->name,
                'slug'                  => $this->slug,
                'description'           => $this->description,
                'price'                 => $this->price,
                'quantity'              => $this->quantity,
                'product_category'      => new ProductCategoriesResource($this->category),
                'featured'              => $this->featured(),
                'status'                => $this->status(),
                'rating'                => round($this->reviews_avg_rating),
                'media'                 => MediaResource::collection($this->media),
                'tags'                  => TagsResource::collection($this->tags),
                'Reviews'               => ProductReviewResource::collection($this->reviews),

        ];
    }
}
