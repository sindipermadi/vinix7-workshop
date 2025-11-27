<h1>Request Mentoring Baru</h1>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('student.mentoring.store') }}">
    @csrf

    <div>
        <label>Mentor</label>
        <select name="mentor_id" required>
            <option value="">-- Pilih Mentor --</option>
            @foreach ($mentors as $mentor)
                <option value="{{ $mentor->id }}">{{ $mentor->name }} ({{ $mentor->email }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Goal</label>
        <input type="text" name="goal" value="{{ old('goal') }}" required>
    </div>

    <div>
        <label>Topic</label>
        <input type="text" name="topic" value="{{ old('topic') }}" required>
    </div>

    <div>
        <label>Preferred Schedule (optional)</label>
        <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}">
    </div>

    <button type="submit">Submit</button>
</form>

<p><a href="{{ route('student.mentoring.index') }}">Kembali</a></p>
