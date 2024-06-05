<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>

    <div class="container w-50 mt-5">
        <h1 class="text-center">Login</h1>
        <form action="/existing-user" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" class="form-control" placeholder="Username">
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
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>

</x-layout>
