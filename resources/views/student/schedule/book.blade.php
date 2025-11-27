<h1>Booking Mentoring</h1>

<p>Mentor : {{ $schedule->mentor?->name }}</p>
<p>Waktu  : {{ $schedule->start_at }} - {{ $schedule->end_at }}</p>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('student.schedule.book', $schedule) }}">
    @csrf

    <div>
        <label>Goal (tujuan mentoring)</label><br>
        <input type="text" name="goal" value="{{ old('goal') }}" required>
    </div>

    <div>
        <label>Topic (topik spesifik)</label><br>
        <input type="text" name="topic" value="{{ old('topic') }}" required>
    </div>

    <button type="submit">Konfirmasi Booking</button>
</form>

<p><a href="{{ route('student.schedule.index') }}">Kembali ke daftar jadwal</a></p>
