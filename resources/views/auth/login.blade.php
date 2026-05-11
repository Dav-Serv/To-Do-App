<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <h1>Login</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if($errors->any())

        <ul>
            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach
        </ul>

    @endif

    <form action="/login" method="POST">
        @csrf
        <div>
            <label>Email</label>
            <br>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email">
        </div>

        <br>

        <div>
            <label>Password</label>
            <br>
            <input type="password" name="password" placeholder="Masukkan password">
        </div>

        <br>

        <button type="submit">
            Login
        </button>

    </form>

    <br>

    <a href="/register">
        Belum punya akun? Register
    </a>
</body>
</html>