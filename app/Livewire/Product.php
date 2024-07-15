<?php

namespace App\Livewire;
use App\Actions\Webshop\AddProductVariantToCart;
use App\Casts\MoneyCast;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;



class Product extends Component
{
    use InteractsWithBanner;
    public $variant;
    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id']
    ];

    protected $casts = [
        'price' => MoneyCast::class,
    ];
    public function render()
    {
        return view('livewire.product');
    }

    public \App\Models\Product $product;

    public function addToCart(AddProductVariantToCart $cart)
    {
        $this->validate();
        $cart->add(
            variantId: $this->variant
        );

        $this->banner('Product added to cart');

        $this->dispatch('cartUpdated');

    }

    public function mount()
    {
//        $this->variant = $this->product->variants()->value('id');
    }

}
