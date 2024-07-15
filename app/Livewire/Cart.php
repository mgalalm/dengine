<?php

namespace App\Livewire;

use App\Actions\Webshop\CreateStripeCheckoutSession;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Cart extends Component
{
    public function mount()
    {

    }

    #[Computed]
    public function cart()
    {
        return \App\Factories\CartFactory::make()->loadMissing([
            'items', 'items.variant', 'items.product', 'items.product.image'
        ]);
    }

    #[Computed]
    public function items()
    {

        return $this->cart->items;
    }


    #[Computed]
    public function total()
    {
        return $this->cart->total;
    }

    public function render()
    {
        return view('livewire.cart');
    }


    public function increment($itemId)
    {
        $this->cart->items->find($itemId)?->increment('quantity');
        $this->dispatch('cartUpdated');
    }

    public function decrement($itemId)
    {
        // make sure it doesn't go below 1
        $this->cart->items->find($itemId)?->decrement('quantity');
        $this->dispatch('cartUpdated');
    }

    public function checkout(CreateStripeCheckoutSession $createStripeCheckoutSession)
    {
        return $createStripeCheckoutSession->createFromCart($this->cart);
    }

    public function removeItem($itemId)
    {
        $this->cart->items->find($itemId)?->delete();


        $this->dispatch('cartUpdated');

        return redirect()->route('cart');
    }

}
