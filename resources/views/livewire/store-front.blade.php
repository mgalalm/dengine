<div class="mt-12">
    <div class="flex justify-between">
        <h1 class="text-xl font-medium">Products</h1>
        <div>
            <x-input wire:model.live.debounce="search" placeholder="Search products" class="w-full"></x-input>
        </div>
    </div>


    <div class="grid grid-cols-4 gap-4 mt-12">
        @foreach($this->products as $product)

            <x-panel class="relative">
                <a wire:navigate href={{ route('product', $product) }} href=""
                   class="absolute inset-0 w-full h-full"></a>
                <img src="{{ $product->image?->path }}" class="rounded">
                <h2 class="font-medium text-lg">{{ $product->name }}</h2>
                <span class="text-grey-700 text-sm">{{ $product->price }}</span>
            </x-panel>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $this->products->links() }}
    </div>
</div>
