<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'User_Id'      => $this->id,
            'first_name'   => $this-> first_name,
            'last_name'    => $this-> last_name,
            'username'     => $this-> username,
            'email'        => $this-> email,
            'mobile'       => $this-> mobile,
            'password'     => $this-> password,
            'user_image'   => $this-> userImage(),
            'status'       => $this-> status(),
        ];
    }
}
