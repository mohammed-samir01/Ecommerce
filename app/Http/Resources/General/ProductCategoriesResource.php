<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoriesResource extends JsonResource
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
            'name'        => $this->name,
            'slug'        => $this->slug,
            'cover'       => $this->cover,
            'status'      => $this->status,
            'parent_id'   => $this->parent_id,
        ];

    }
}
