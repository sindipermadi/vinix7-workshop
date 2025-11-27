<h1>Jobs - Student</h1>

<p><a href="{{ route('student.jobs.applications') }}">Lihat Lamaran Saya</a></p>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Type</th>
            <th>Level</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($jobs as $job)
        <tr>
            <td>{{ $job->id }}</td>
            <td>{{ $job->title }}</td>
            <td>{{ $job->company }}</td>
            <td>{{ $job->location }}</td>
            <td>{{ $job->job_type }}</td>
            <td>{{ $job->level }}</td>
            <td>{{ $job->status }}</td>
            <td>{{ $job->deadline }}</td>
            <td>
                <a href="{{ route('student.jobs.show', $job) }}">Detail</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9">Belum ada job aktif.</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $jobs->links() }}

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
