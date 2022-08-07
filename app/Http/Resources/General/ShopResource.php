<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'products'    => ProductsResource::collection($this->products),
            'categories'  => ProductCategoriesResource::collection($this->categories),
            'tags'        => TagsResource::collection($this->tags),
         ];
    }
}
