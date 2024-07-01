<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function getItemsProperty()
    {

        return \App\Factories\CartFactory::make()->items()->with('variant', 'product')->get();
    }
    public function render()
    {
        return view('livewire.cart');
    }

    public function removeItem($itemId)
    {
        \App\Factories\CartFactory::make()->items()->where('id', $itemId)->delete();
        $this->dispatch('cartUpdated');
    }

    public function increment($itemId)
    {
        \App\Factories\CartFactory::make()->items()->where('id', $itemId)->increment('quantity');
        $this->dispatch('cartUpdated');
    }

    public function decrement($itemId)
    {
        // make sure it doesn't go below 1
        \App\Factories\CartFactory::make()->items()->where('id', $itemId)->where('quantity', '>', 1)->decrement('quantity');
        $this->dispatch('cartUpdated');
    }
}
