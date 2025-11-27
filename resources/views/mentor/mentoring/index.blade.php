<h1>Mentoring - Mentor</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="6">
    <thead>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Goal</th>
            <th>Topic</th>
            <th>Scheduled At</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sessions as $session)
            <tr>
                <td>{{ $session->id }}</td>
                <td>{{ $session->student?->name }}</td>
                <td>{{ $session->goal }}</td>
                <td>{{ $session->topic }}</td>
                <td>{{ $session->scheduled_at }}</td>
                <td>{{ $session->status }}</td>
                <td>
                    <a href="{{ route('mentor.mentoring.edit', $session) }}">Edit</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Belum ada sesi mentoring.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
