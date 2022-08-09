<?php

namespace App\Http\Resources\General;


use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "id"      =>$this->id, 
            "user_id" =>$this->user_id,
            "product_id"=> $this->product->id,
            "price"=> $this->price,
            "quantity"=> $this->quantity,
        /*     'ProductName'           => $this->name,
            'price'                 => $this->price,
            'quantity'              => $this->quantity,
            'Images'                => MediaResource::collection($this->media)->first(),
            'review'                => ProductReviewResource::collection($this->reviews),
 */

    ];
    }
}
