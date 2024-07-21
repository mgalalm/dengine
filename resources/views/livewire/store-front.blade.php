<div class="mt-8">
    <div class="container mx-auto grid grid-cols-12 gap-12 px-4 mb-2">
{{--        <div class="col-span-12 md:col-span-10">--}}

{{--            <x-input wire:model.live.debounce="search" placeholder="Search products" class="w-full"></x-input>--}}
{{--        </div>--}}
{{--        <div class="col-span-12 md:col-span-2">--}}
{{--            <x-dropdown>--}}
{{--                <x-slot name="trigger">--}}
{{--                    <x-button>Sort</x-button>--}}
{{--                </x-slot>--}}
{{--                <x-slot name="content">--}}
{{--                    <x-dropdown-link href="?sort=price_asc">Price: Low to High</x-dropdown-link>--}}
{{--                    <x-dropdown-link href="?sort=price_desc" >Price: High to Low</x-dropdown-link>--}}
{{--                </x-slot>--}}
{{--            </x-dropdown>--}}
{{--        </div>--}}


    </div>



    <div class="container mx-auto grid grid-cols-12 gap-8 px-4">
        <div class="col-span-12 md:col-span-8 lg:col-span-9">

            <x-input wire:model.live.debounce="search" placeholder="Search products" class="w-full"></x-input>
        </div>
        <div class="col-span-12 md:col-span-3 md:col-span-4">
            <x-dropdown>
                <x-slot name="trigger">
                    <x-button class="w-full  justify-center">Sort</x-button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link href="?sort=price_asc">Price: Low to High</x-dropdown-link>
                    <x-dropdown-link href="?sort=price_desc" >Price: High to Low</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
        @foreach($this->products as $product)

            <x-panel class="relative col-span-12 grid grid-cols-5 border p-4 sm:col-span-6 sm:grid-cols-1 sm:grid-rows-[max-content_1fr] md:col-span-4 lg:col-span-3">
                <a wire:navigate href="{{ route('product', $product) }}"
                   class="absolute inset-0 w-full h-full"></a>

                <div class="col-span-2 mr-4 flex sm:col-span-1 sm:mb-4 sm:mr-0 sm:h-[17em"><img src="{{ Storage::url($product->image?->path) }}" class="rounded"></div>

                <div class="col-span-3 flex flex-col sm:col-span-1">
                    <div class="mb-4 flex-1"></div>
                    <h2 class="font-medium text-lg">{{ $product->name }}</h2>
                <span class="text-grey-700 text-sm">{{ $product->price }}</span>
                </div>
            </x-panel>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $this->products->links() }}
    </div>
</div>
