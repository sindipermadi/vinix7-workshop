<h1>Job Detail</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<h2>{{ $job->title }}</h2>
<p>Company : {{ $job->company }}</p>
<p>Location: {{ $job->location }}</p>
<p>Type    : {{ $job->job_type }}</p>
<p>Level   : {{ $job->level }}</p>
<p>Deadline: {{ $job->deadline }}</p>
<p>Status  : {{ $job->status }}</p>

<h3>Description</h3>
<p>{{ $job->description }}</p>

@if($job->requirements)
    <h3>Requirements</h3>
    <p>{{ $job->requirements }}</p>
@endif

<hr>

@if($applied)
    <h3>Status Lamaran Kamu</h3>
    <p>
        <strong>Status:</strong> {{ ucfirst($appStatus) }}
    </p>

    @if($application?->admin_note)
        <p><strong>Catatan dari Admin / Mentor:</strong></p>
        <p>{{ $application->admin_note }}</p>
    @else
        {{-- Pesan default kalau admin belum ngisi catatan --}}
        @if($appStatus === 'pending')
            <p><em>Lamaran kamu sudah masuk dan sedang menunggu review. Mohon cek berkala.</em></p>
        @elseif($appStatus === 'reviewed')
            <p><em>Lamaran kamu sudah ditinjau. Tunggu catatan atau instruksi lanjutan dari admin.</em></p>
        @elseif($appStatus === 'accepted')
            <p><em>Lamaran kamu diterima. Namun belum ada instruksi lanjutan dari admin di sistem. Cek email / grup resmi kalau ada info tambahan.</em></p>
        @elseif($appStatus === 'rejected')
            <p><em>Lamaran kamu tidak diteruskan. Admin belum memberikan catatan tambahan.</em></p>
        @endif
    @endif
@else
    <h3>Apply Job</h3>
    <form method="POST" action="{{ route('student.jobs.apply', $job) }}">
        @csrf
        <div>
            <label>Cover Letter (optional)</label><br>
            <textarea name="cover_letter" rows="4">{{ old('cover_letter') }}</textarea>
        </div>
        <button type="submit">Kirim Lamaran</button>
    </form>
@endif

<p><a href="{{ route('student.jobs.index') }}">Kembali ke daftar jobs</a></p>
