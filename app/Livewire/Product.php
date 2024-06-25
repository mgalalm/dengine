<?php

namespace App\Livewire;
use App\Actions\Webshop\AddProductVariantToCart;
use Livewire\Component;
use function dump;


class Product extends Component
{

    public $variant;
    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id']
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

    }

    public function mount()
    {
//        $this->variant = $this->product->variants()->value('id');
    }

}
