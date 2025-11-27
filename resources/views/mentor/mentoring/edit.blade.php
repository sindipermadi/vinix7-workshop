<h1>Edit Mentoring Session #{{ $session->id }}</h1>

<p>Student : {{ $session->student?->name }}</p>
<p>Goal    : {{ $session->goal }}</p>
<p>Topic   : {{ $session->topic }}</p>
<p>Schedule: {{ $session->scheduled_at }}</p>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('mentor.mentoring.update', $session) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Status</label>
        <select name="status" required>
            <option value="pending"   @selected($session->status === 'pending')>Pending</option>
            <option value="approved"  @selected($session->status === 'approved')>Approved</option>
            <option value="completed" @selected($session->status === 'completed')>Completed</option>
            <option value="canceled"  @selected($session->status === 'canceled')>Canceled</option>
        </select>
    </div>

    <div>
        <label>Notes (optional)</label><br>
        <textarea name="notes" rows="4" cols="40">{{ old('notes', $session->notes) }}</textarea>
    </div>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('mentor.mentoring.index') }}">Kembali</a></p>
