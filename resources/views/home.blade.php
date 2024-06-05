<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>

    @auth

    <div class="container-fluid text-center p-3 m-3">
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
    </div>
        
    @else

    <div class="container-fluid text-center p-3 m-3">
        <h1>Welcome to eShop.com!</h1>
    </div>

    @endauth

    @foreach ($products as $product)
        <div class="card p-3 m-3">
            <div class="row">
                <div class="col-2">
                    <img class="card-img-left" src="/images/default.jpg" alt="Card image cap">
                </div>
                <div class="col">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">RM {{ $product['price'] }}</h6>
                        <p class="card-text">{{ empty($product['description']) ? 'No description' : $product['description'] }}</p>
                        <form action="/add-to-cart/{{ $product['id'] }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-layout>
