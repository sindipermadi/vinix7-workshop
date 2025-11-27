<h1>Tambah Slot Jadwal</h1>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('mentor.schedule.store') }}">
    @csrf

    <div>
        <label>Start At</label>
        <input type="datetime-local" name="start_at" value="{{ old('start_at') }}" required>
    </div>

    <div>
        <label>End At</label>
        <input type="datetime-local" name="end_at" value="{{ old('end_at') }}" required>
    </div>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('mentor.schedule.index') }}">Kembali</a></p>
