<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Money\Currency;
use Money\Money;

class Cart extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->reduce(fn (Money $total, CartItem $item) => $total->add($item->subtotal), new Money(0, new Currency('eur'))),
        );
    }
}

