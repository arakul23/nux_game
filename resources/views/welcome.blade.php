<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Register</title>
</head>
<body>
<div class="page">
    <form class="form-box" method="POST" action="{{ route('register') }}">
        @csrf

        <h1>Register</h1>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        <label for="username">Username</label>
        <input
            id="username"
            name="username"
            type="text"
            value="{{ old('username') }}"
            required
        >
        @error('username')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="phonenumber">Phonenumber</label>
        <input
            id="phonenumber"
            name="phonenumber"
            type="text"
            value="{{ old('phonenumber') }}"
            required
        >
        @error('phonenumber')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
