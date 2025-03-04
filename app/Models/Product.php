<?php

namespace App\Models;


use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Money\Currency;
use Money\Money;


class Product extends Model
{
    use HasFactory;
//    public $casts = [
//        'price' => MoneyCast::class,
//    ];

    public function price(): Attribute
    {
        return Attribute::make(
            get: function (int $value) {
                return new Money($value, new Currency('EUR'));
            }
        );
    }

    // create a relation between product and product_variant
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }


    // create a relation between product and product_image
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }


    public function image() : HasOne
    {

        return $this->hasOne(Image::class)->ofMany('featured', aggregate: 'max');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
