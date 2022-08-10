<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class RelatedProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id'                    => $this->id,
                'name'                  => $this->name,
                'slug'                  => $this->slug,
                'description'           => $this->description,
                'price'                 => $this->price,
                'quantity'              => $this->quantity,
                'product_category'      => new ProductCategoriesResource($this->category),
                'featured'              => $this->featured,
                'status'                => $this->status,
                'created_at'            => $this->created_at,
                'updated_at'            => $this->updated_at,
                'Media'                 => $this->media->first(),
            ];
    }
}
