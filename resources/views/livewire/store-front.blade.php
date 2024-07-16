<div class="mt-8">
    <div class="flex justify-between">

        <x-dropdown>
            <x-slot name="trigger">
                <x-button>Categories</x-button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link href="/">All</x-dropdown-link>
                @foreach($this->categories as $category)
                    <x-dropdown-link href="?category={{ $category->id }}" :active="$this->category">{{ $category->name }}</x-dropdown-link>
                @endforeach
            </x-slot>
        </x-dropdown>
        <div>

            <x-input wire:model.live.debounce="search" placeholder="Search products" class="w-full"></x-input>
        </div>

    </div>



    <div class="grid grid-cols-4 gap-4 mt-8">
        @foreach($this->products as $product)

            <x-panel class="relative">
                <a wire:navigate href={{ route('product', $product) }} href=""
                   class="absolute inset-0 w-full h-full"></a>
                <img src="{{ Storage::url($product->image?->path) }}" class="rounded">
                <h2 class="font-medium text-lg">{{ $product->name }}</h2>
                <span class="text-grey-700 text-sm">{{ $product->price }}</span>
            </x-panel>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $this->products->links() }}
    </div>
</div>
