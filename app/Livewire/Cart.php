<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function getCartProperty()
    {
        return \App\Factories\CartFactory::make()->loadMissing(['items', 'items.variant', 'items.product', 'items.product.image']);
    }

    public function getItemsProperty()
    {

        return $this->cart->items;
    }


    public function getTotalProperty()
    {
        return $this->cart->total;
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function removeItem($itemId)
    {
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch('cartUpdated');
    }

    public function increment($itemId)
    {
        $this->cart->items()->where('id', $itemId)->increment('quantity');
        $this->dispatch('cartUpdated');
    }

    public function decrement($itemId)
    {
        // make sure it doesn't go below 1
        $this->cart->items()->where('id', $itemId)->where('quantity', '>', 1)->decrement('quantity');
        $this->dispatch('cartUpdated');
    }
}
