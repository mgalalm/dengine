<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;
    #[Computed]
    public function orders()
    {
        return auth()->user()->orders()->paginate(5);
    }

    public function render()
    {
        return view('livewire.my-orders');
    }
}
