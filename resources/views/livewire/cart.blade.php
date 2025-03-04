<div class="grid grid-cols-4  mt-12 gap-4">
    <x-panel class="md:col-span-3 col-span-4 order-2 md:order-first">
        <table class="w-full">
            <thead>
            <tr>
                <th class="text-left hidden sm:table-cell"></th>
                <th class="text-left">Product</th>
                <th class="text-left">Size</th>
                <th class="text-left">Color</th>
                <th class="text-left">Price</th>

                <th class="text-left">Quantity</th>
                <th class="text-left">Total</th>

                <th class="text-left"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($this->items as $item)
                <tr wire:key="{{ $item->id }}" >
                    <td class="flex items-center hidden sm:table-cell">

                        <img src="{{ Storage::url($item->product->image->path) }}" alt="{{ $item->product->name }}" class="h-8 w-8">


                    </td>
                    <td><span>{{ $item->product->name }}  </span></td>
                    <td><span>{{ $item->variant->size }}</span></td>
                    <td><span>{{ $item->variant->color }}</span></td>
                    <td><span>{{ $item->product->price }}</span></td>
                    <td class="flex space-x-2">
                        <button wire:click="increment({{ $item->id }})">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>


                        </button>
                        <div>{{ $item->quantity }}</div>
                        <button wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                            </svg>


                        </button>


                    </td>
                    <td><span>{{ $item->subtotal }}</span></td>
                    <td class="text-right">
                        <button wire:click="removeItem({{ $item->id }})" class="text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6" class="text-right font-medium">Total:</td>
                <td class="font-medium text-right">{{ $this->total }}</td>

            </tr>
            </tfoot>
        </table>
    </x-panel>
    <div class="md:col-span-1 col-span-4 ">
        <x-panel>
            @guest()
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('login') }}"
                       class="bg-blue-500 text-white text-center py-2 rounded-lg">Login</a>
                    <a href="{{ route('register') }}"
                       class="bg-blue-500 text-white text-center py-2 rounded-lg">Register</a>
                </div>

            @endguest
            @auth()
                <div class="flex flex-col space-y-4">
                    <h2 class="text-lg font-semibold">Total: {{ $this->total }}</h2>
                   <x-button wire:click="checkout" class="w-full justify-center">Checkout</x-button>
                </div>
            @endauth
        </x-panel>
    </div>
</div>
