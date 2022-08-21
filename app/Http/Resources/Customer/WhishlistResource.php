<?php

namespace App\Http\Resources\Customer;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class WhishlistResource extends JsonResource
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
            'product' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'image' => Media::where('mediable_id',$this->id)->get('file_name')->first(),
        ];
    }
}
