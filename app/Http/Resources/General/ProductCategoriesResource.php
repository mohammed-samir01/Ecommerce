<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoriesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'cover'       => $this->cover,
            'status'      => $this->status(),
        ];

    }
}
