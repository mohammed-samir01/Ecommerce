<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
              'file_name'       => $this->file_name,
//            'file_type'       => $this->file_type,
//            'file_size'       => $this->file_size,
//            'file_status'     => $this->file_status,
//            'file_sort'       => $this->file_sort,
//            'mediable_id'     => $this->mediable_id,
//            'mediable_type'   => $this->mediable_type,
//            'url'             => asset('assets/products/'. $this->file_name),
        ];
    }
}
