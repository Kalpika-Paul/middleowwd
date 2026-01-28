<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Authentication</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <link rel="preload" as="image" href="{{ asset('frontend/img/bg.jpg') }}">
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
   
</head>


<body>
<div class="login-page">
    <div class="container">
        <div class="login-wrapper">
            <form action="{{ route('admin.auth') }}" method="POST" >
                @csrf
                <h2 style="color:aliceblue">Admin Login</h2>
                <div class="input-field">
                    <input type="email" name="email" required>
                    <label>Enter Your Email</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" required>
                    <label>Enter Your Password</label>
                </div>
                <button type="submit">Log In</button>
    </div>        </form>
        </div>
    </div>
    </div>

</body>

</html>