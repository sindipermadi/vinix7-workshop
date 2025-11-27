<h1>Available Schedule</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Mentor</th>
            <th>Start</th>
            <th>End</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($schedules as $schedule)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $schedule->mentor?->name }}</td>
                <td>{{ $schedule->start_at }}</td>
                <td>{{ $schedule->end_at }}</td>
                <td>{{ $schedule->status }}</td>
 <td>
    <a href="{{ route('student.schedule.book.form', $schedule) }}">
        Book
    </a>
</td>

            </tr>
        @empty
            <tr>
                <td colspan="6">Belum ada jadwal available.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<p><a href="{{ route('student.mentoring.index') }}">Lihat Riwayat Mentoring</a></p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
