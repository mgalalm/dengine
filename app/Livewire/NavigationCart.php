<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NavigationCart extends Component
{
    public $listeners = ['cartUpdated' => '$refresh'];
    public function render()
    {
        return view('livewire.navigation-cart');
    }
    #[Computed]
    public function count()
    {
        return CartFactory::make()->items()->sum('quantity');
    }
}
