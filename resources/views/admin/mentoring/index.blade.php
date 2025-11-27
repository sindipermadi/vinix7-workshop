<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mentoring - Admin</title>
</head>
<body>
    <h1>Mentoring - Admin</h1>

<p>
    <a href="{{ route('admin.mentoring.print') }}" target="_blank">Print (HTML)</a> |
    <a href="{{ route('admin.mentoring.pdf') }}">Download PDF</a>
</p>


    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Mentor</th>
                <th>Goal</th>
                <th>Topic</th>
                <th>Scheduled At</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($sessions as $session)
            <tr>
                <td>{{ $session->id }}</td>
                <td>{{ $session->student?->name }}</td>
                <td>{{ $session->mentor?->name }}</td>
                <td>{{ $session->goal }}</td>
                <td>{{ $session->topic }}</td>
                <td>{{ $session->scheduled_at }}</td>
                <td>{{ $session->status }}</td>
                <td>{{ $session->notes }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8">Belum ada sesi mentoring.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
