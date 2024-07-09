<div>
    <x-panel title="My Orders">
        <table class="w-full">
            <thead>
            <tr>
                <th class="text-left" >Order</th>
                <th class="text-left" >Ordered at</th>
{{--                <th class="text-left" >Status</th>--}}
                <th class="text-right   ">Total</th>
            </tr>
</thead>

<tbody>
@foreach($this->orders as $order)
<tr>
    <td>
        <a href="{{ route('view-order', $order->id) }}" class="text-blue-500 hover:underline">#{{ $order->id }}</a>
    </td>
    <td>{{ $order->created_at->format('m/d/Y') }}</td>
{{--    <td>{{ $order->status }}</td>--}}
    <td class="text-right
    ">{{ $order->amount_total }}</td>
</tr>
@endforeach
</tbody>
        </table>
    </x-panel>
    <div class="mt-6">
        {{ $this->orders->links() }}
    </div>


</div>
