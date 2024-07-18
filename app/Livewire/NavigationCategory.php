<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Computed;

class NavigationCategory extends Component
{
    public function render()
    {
        return view('livewire.navigation-category');
    }
    #[Computed]
    public function categories()
    {
        return Category::all();
    }
}
