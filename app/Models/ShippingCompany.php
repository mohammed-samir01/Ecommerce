<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class ShippingCompany extends Model
{
    use HasFactory, SearchableTrait;
    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'shipping_companies.name'       => 10,
            'shipping_companies.code'       => 10,
            'shipping_companies.description'=> 10,
        ]
    ];

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function fast(): string
    {
        return $this->fast ? 'Fast delivery' : 'Normal delivery';
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'shipping_company_country');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
