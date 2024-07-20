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
    #[Computed]
    public function parents()
    {
        return Category::whereNull('parent_id')->get();
    }

    #[Computed]
    public function getChildren($id)
    {
        return Category::where('parent_id', $id)->get();
    }
}
