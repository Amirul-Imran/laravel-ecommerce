<x-layout>
    <x-slot:title>
        Sell
    </x-slot:title>

    <div class="container w-50 mt-5">
        <h1 class="text-center">Sell Item</h1>
        <form action="/sell-item" method="POST">
            @csrf
            <div class="form-group">
                <label>Item Name</label>
                <input type="text" name="name" class="form-control" placeholder="Item Name">
                @if ($errors->any())
                    <div class="invalid-feedback">
                        Something went wrong
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Price (RM)</label>
                <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Type your description here"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">List Item</button>
        </form>
    </div>

</x-layout>