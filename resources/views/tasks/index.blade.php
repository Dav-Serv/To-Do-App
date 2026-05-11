<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
</head>
<body>
    <h1>To-Do App</h1>

    <h3>
        Welcome,
        {{ session('user_name') }}
    </h3>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <hr>

    <h2>Tambah Task</h2>

    <form action="/tasks" method="POST">
        @csrf
        <div>
            <label>Title</label>

            <br>

            <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan judul task">
        </div>

        <br>

        <div>
            <label>Description</label>

            <br>

            <textarea name="description"placeholder="Masukkan deskripsi task">{{ old('description') }}</textarea>
        </div>

        <br>

        <button type="submit">
            Tambah Task
        </button>
    </form>

    <hr>

    <h2>Daftar Task</h2>

    @forelse($tasks as $task)
        <div>
            <h3>{{ $task->title }}</h3>
            <p>{{ $task->description }}</p>
            <p>Status: {{ $task->status }}</p>

            <a href="/tasks/{{ $task->id }}">
                Detail JSON
            </a>
        </div>

        <hr>

    @empty
        <p>Belum ada task.</p>
    @endforelse

    <form action="/logout" method="POST">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>
</body>
</html>