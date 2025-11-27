<h1>My Schedule</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<p><a href="{{ route('mentor.schedule.create') }}">Tambah Slot Jadwal</a></p>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
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
                <td>{{ $schedule->start_at }}</td>
                <td>{{ $schedule->end_at }}</td>
                <td>{{ $schedule->status }}</td>
                <td>
                    <a href="{{ route('mentor.schedule.edit', $schedule) }}">Edit</a>
                    <form action="{{ route('mentor.schedule.destroy', $schedule) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus slot ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada jadwal.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
