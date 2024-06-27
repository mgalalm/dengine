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
}
