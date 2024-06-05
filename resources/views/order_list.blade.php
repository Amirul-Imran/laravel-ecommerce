<x-layout>
    <x-slot:title>
        Orders List
    </x-slot:title>

    <div class="container mt-3">
        <h1 class="py-3">Orders</h1>
        <div class="list-group">
            @foreach ($orders as $order)
            <a href="/order/{{ $order->id }}" class="list-group-item list-group-item-action">Order #{{ $order->id }} - {{ $order->created_at }}</a>    
            @endforeach
        </div>
    </div>

</x-layout>
