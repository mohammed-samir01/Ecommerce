<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $guarded = [];


    // public function order(){
    //     $this->belongsTo(Order::class);
    // }



    public function notifiable()
    {
        return $this->morphTo();
    }

    public function users(){
        $this->belongsToMany(User::class);
    }
}

