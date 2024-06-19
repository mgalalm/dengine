<div class="grid grid-cols-2 gap-10 py-12">
    <div class="space-y-4">
        <div class="bg-white p-5 rounded-lg shadow">
            <img src="/{{ $product->image->path }}">
        </div>
        <!-- Loop all other images in this indvidual product-->
        <div>
            <div class="grid grid-cols-4 gap-4">
                @foreach($product->images as $image)
                    <div class="rounded bg-white p-2 rounded shadow">
                         <img src="/{{ $image->path }}" class="rounded">
                    </div>
                @endforeach
            </div>

            {{-- If your happiness depends on money, you will never be happy with yourself. --}}
        </div>
    </div>
    <div>
       <h1 class="text-3xl font-medium"> {{ $product->name }}</h1>
        <div class="mt-4">
            {{ $product->description }}
        </div>
        <!-- add all variations of this product -->
        <div class="mt-4 space-y-4">
                <select class="block w-full rounded-md broder-0 py-1.15 pl-3 pr10 text-gray-800">
                    @foreach($product->variants as $variant)
                       <option value="{{ $variant->id }}">{{$variant->size}} / {{$variant->color}} </option>
                    @endforeach
                </select>
            <x-button class="mt-4">Add to Cart</x-button>
        </div>
    </div>
</div>
