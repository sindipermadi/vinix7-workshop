<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Student Dashboard</h1>
    <p>Halo, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
