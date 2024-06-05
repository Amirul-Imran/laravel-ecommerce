<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>

    <div class="container w-50 mt-5">
        <h1 class="text-center">Register</h1>
        <form action="/new-user" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Password Confirmation</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

</x-layout>
