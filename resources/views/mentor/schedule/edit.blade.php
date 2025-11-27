<h1>Edit Slot Jadwal</h1>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('mentor.schedule.update', $schedule) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Start At</label>
        <input type="datetime-local" name="start_at"
               value="{{ old('start_at', $schedule->start_at?->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div>
        <label>End At</label>
        <input type="datetime-local" name="end_at"
               value="{{ old('end_at', $schedule->end_at?->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div>
        <label>Status</label>
        <select name="status" required>
            <option value="available" @selected($schedule->status === 'available')>Available</option>
            <option value="booked" @selected($schedule->status === 'booked')>Booked</option>
            <option value="canceled" @selected($schedule->status === 'canceled')>Canceled</option>
        </select>
    </div>

    <button type="submit">Update</button>
</form>

<p><a href="{{ route('mentor.schedule.index') }}">Kembali</a></p>
