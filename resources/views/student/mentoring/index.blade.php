<h1>Mentoring - Student</h1>

<p><a href="{{ route('student.mentoring.create') }}">Request Mentoring Baru</a></p>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="6">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mentor</th>
            <th>Goal</th>
            <th>Topic</th>
            <th>Scheduled At</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sessions as $session)
            <tr>
                <td>{{ $session->id }}</td>
                <td>{{ $session->mentor?->name }}</td>
                <td>{{ $session->goal }}</td>
                <td>{{ $session->topic }}</td>
                <td>{{ $session->scheduled_at }}</td>
                <td>{{ $session->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Belum ada sesi mentoring.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
