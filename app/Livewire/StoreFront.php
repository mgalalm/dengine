<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class StoreFront extends Component
{
    public function render()
    {
        return view('livewire.store-front');
    }

    public function  getProductsProperty()
    {
        return Product::all();
    }
}
