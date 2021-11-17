@extends('header')

@section('comment')

@stop

@section('content')

<!--===============================
=            Hero Area            =
================================-->

<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border border">
                    <h3 class="bg-gray p-4">Register Now</h3>
                    <form action="/register" method="POST">
                        <fieldset class="p-4">
                            <input type="email" placeholder="Email" name="email" class="border p-3 w-100 my-2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            <input type="name" placeholder="Name" name="name" class="border p-3 w-100 my-2" required>
                            <input type="username" placeholder="Username" name="username" class="border p-3 w-100 my-2" pattern=".{6,}" required>
                            <input type="password" placeholder="password" name="password" class="border p-3 w-100 my-2" pattern=".{6,}" id="new-password" required>
                            <input type="password" placeholder="password_confirm" name="password_confirm" class="border p-3 w-100 my-2" pattern=".{6,}" id="confirm-password" required>
                            <div class="loggedin-forgot d-inline-flex my-3">
                                    <input type="checkbox" id="registering" class="mt-1" required>
                                    <label for="registering" class="px-2">By registering, you accept our <a class="text-primary font-weight-bold" href="terms-condition.html">Terms & Conditions</a></label>
                            </div>
                            @foreach ($errors->all() as $error)
                                <p style="color:red">{{ $error }}</p>
                            @endforeach
                            <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">Register Now</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
