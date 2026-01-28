<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Authentication</title>
    <link rel="preload" as="image" href="{{ asset('frontend/img/bg.jpg') }}">
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>


<body>

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
            </form>
        </div>
    </div>
    </div>

</body>

</html>