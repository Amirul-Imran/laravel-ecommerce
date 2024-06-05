<x-layout>
    <x-slot:title>
        Order Items
    </x-slot:title>

    @php
        $i = 0;
    @endphp

    <div class="container mt-3">
        <h1 class="py-3">Order Items</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $item)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $item->name }}</td>
                    <td>RM {{ $item->unit_price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>RM {{ number_format($item->unit_price * $item->quantity, 2, '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">TOTAL</th>
                  <th scope="col">RM {{ number_format($order->total_price, 2, '.') }}</th>
                </tr>
              </thead>
          </table>
    
          @if ($order->status == 'Pending')
    
            <form action="/update-status/{{ $order->id }}" method="POST">
            @csrf
            <a class="btn btn-outline-primary mt-2" href="/order_list" role="button">Back</a>
            <button class="btn btn-primary float-right mr-3 mt-2">Order Received</button>
            </form>
              
          @else
    
            <h3>Order Received. Thank you for your purchase!</h3>
            <a class="btn btn-outline-primary mt-2" href="/order_list" role="button">Back</a>
    
          @endif
    </div>
    
</x-layout>
