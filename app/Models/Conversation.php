<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates=['last_message_at'];
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
