<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail , JWTSubject
{
    use HasApiTokens, SearchableTrait,HasFactory, Notifiable,EntrustUserWithPermissionsTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'mobile',
        'user_image',
        'status',
        'email',
        'password',
        'is_verified'

    ];

    protected $appends = ['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $searchable = [
        'columns' => [
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.username' => 10,
            'users.email' => 10,
            'users.mobile' => 10,
        ]
    ];

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'App.Models.User.' . $this->id;
    }

    public function getFullNameAttribute(): string
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function userImage()
    {

        return $this->user_image != '' ? $this->user_image : 'avatar.svg';

    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

##############################

    public function products()
    {
        return $this->BelongsToMany(Product::class);
    }

}
