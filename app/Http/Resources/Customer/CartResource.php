<?php

namespace App\Http\Resources\Customer;

use App\Models\Media;
use App\Models\Product;
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
            'id' => $this->id,
            'product' => Product::where('id',$this->product_id)->get('name'),
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total,
            'image' => Media::where('mediable_id',$this->product_id)->get('file_name')->first(),
        ];
    }
}
