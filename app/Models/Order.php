<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use HasFactory, SearchableTrait;
    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'orders.ref_id'                         => 10,
            'users.first_name'                      => 10,
            'users.last_name'                       => 10,
            'users.username'                        => 10,
            'users.email'                           => 10,
            'users.mobile'                          => 10,
            'user_addresses.address_title'          => 10,
            'user_addresses.first_name'             => 10,
            'user_addresses.last_name'              => 10,
            'user_addresses.email'                  => 10,
            'user_addresses.mobile'                 => 10,
            'user_addresses.address'                => 10,
            'user_addresses.address2'               => 10,
            'user_addresses.zip_code'               => 10,
            'user_addresses.po_box'                 => 10,
            'shipping_companies.name'               => 10,
            'shipping_companies.code'               => 10,
        ],
        'joins' => [
            'users' => ['users.id','orders.user_id'],
            'user_addresses' => ['user_addresses.id','orders.user_address_id'],
            'shipping_companies' => ['shipping_companies.id','orders.shipping_company_id'],
        ],
    ];

    const NEW_ORDER = 0;
    const PAYMENT_COMPLETED = 1;
    const UNDER_PROCESS = 2;
    const FINISHED = 3;
    const REJECTED = 4;
    const CANCELED = 5;
    const REFUNDED_REQUEST = 6;
    const RETURNED = 7;
    const REFUNDED = 8;

    public function currency(): string
    {
        return $this->currency == 'USD' ? '$' : $this->currency;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user_address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shipping_company(): BelongsTo
    {
        return $this->belongsTo(ShippingCompany::class);
    }

    public function status($transaction_number = null)
    {
        $transaction = $transaction_number != '' ? $transaction_number : $this->order_status;

        switch ($transaction) {
            case 0: $result = 'New order'; break;
            case 1: $result = 'Paid'; break;
            case 2: $result = 'Under process'; break;
            case 3: $result = 'Finished'; break;
            case 4: $result = 'Rejected'; break;
            case 5: $result = 'Canceled'; break;
            case 6: $result = 'Refund requested'; break;
            case 7: $result = 'Refunded'; break;
            case 8: $result = 'Returned order'; break;
        }
        return $result;
    }

    public function statusWithLabel()
    {
        switch ($this->order_status) {
            case 0: $result = '<label class="badge badge-success">New order</label>'; break;
            case 1: $result = '<label class="badge badge-warning">Paid</label>'; break;
            case 2: $result = '<label class="badge badge-warning">Under process</label>'; break;
            case 3: $result = '<label class="badge badge-primary">Finished</label>'; break;
            case 4: $result = '<label class="badge badge-danger">Rejected</label>'; break;
            case 5: $result = '<label class="badge badge-dark text-white">Canceled</label>'; break;
            case 6: $result = '<label class="badge bg-dark text-white">Refund requested</label>'; break;
            case 7: $result = '<label class="badge bg-slate">Returned order</label>'; break;
            case 8: $result = '<label class="badge bg-dark text-white">Refunded order</label>'; break;
        }
        return $result;
    }
}
