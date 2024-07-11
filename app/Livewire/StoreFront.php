<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StoreFront extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $category;
    public function render()
    {
        return view('livewire.store-front');
    }

    #[Computed]
    public function  products()
    {
        return Product::query()
            ->where('is_published', true)
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->when($this->category, function ($query) {
                $query->whereHas('categories', function ($query) {
                    $query->where('categories.id', $this->category);
                });
            })

            ->paginate(4);
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }
}
