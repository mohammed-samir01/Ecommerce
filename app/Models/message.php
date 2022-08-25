<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'chat_id',
        'content'
    ];
    public function chat(){
        return $this->belongsTo(chat::class);
    }
    
}
