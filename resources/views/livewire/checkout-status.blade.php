<div class="bg-white rounded shadow mt-12 p-5 max-w-xl mx-auto">
   @if($this->order)
        <div class="alert alert-success">
             Your order has been placed successfully. Your order number is {{ $this->order->id }}.
        </div>
    @else
        <div  wire:poll>
           Waiting for payment confirmation. Please standby ..
        </div>
   @endif
</div>
