<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $casts = [
        'billing_address' => 'collection',
        'shipping_address' => 'collection',
        'amount_total' => MoneyCast::class,
        'amount_discount' => MoneyCast::class,
        'amount_tax' => MoneyCast::class,
        'amount_subtotal' => MoneyCast::class,
        'amount_shipping' => MoneyCast::class,
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
