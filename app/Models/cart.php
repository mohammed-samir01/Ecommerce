<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'price',
        'quantity'
    ];
    public function cart_user(){
        return $this->belongsTo(User::class);
    }
}
