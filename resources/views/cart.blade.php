<x-layout>
    <x-slot:title>
        Cart Items
    </x-slot:title>

    @php
        $i = 0;
    @endphp

    <div class="container mt-3">
        <h1 class="py-3">Cart Items</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cart_items as $item)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $item->name }}</td>
                    <td>RM {{ $item->price }}</td>
                    <td>
                        <form action="/update-quantity/{{ $item->id }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" name="quantity" class="form-control col-2" value="{{ $item->quantity }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td>RM {{ number_format($item->price * $item->quantity, 2, '.') }}</td>
                    <td>
                        <form action="/delete-cart-item/{{ $item->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">TOTAL</th>
                  <th scope="col">RM {{ number_format($cart_items->sum(function ($item) {
                        return $item->price * $item->quantity;
                  }), 2, '.') }}</th>
                  <th></th>
                </tr>
              </thead>
          </table>
    
        @if ($i > 0)
        <form action="/place-order" method="POST">
        @csrf
        <button class="btn btn-primary ml-auto float-right mr-3">Place Order</button>
        </form>
        @endif
    </div>
    
    
</x-layout>
