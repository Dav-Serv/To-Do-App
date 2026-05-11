<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/register" method="POST">
        @csrf
        <div>
            <label>Nama</label>
            <br>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama">
        </div>

        <br>

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
            Register
        </button>
    </form>

    <br>

    <a href="/login">
        Sudah punya akun? Login
    </a>
</body>
</html>