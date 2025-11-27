<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jobs - Admin</title>
</head>
<body>
<h1>Jobs - Admin</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<p>
    <a href="{{ route('admin.jobs.create') }}">+ Tambah Job</a>
</p>

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
            <th>Dibuat oleh</th>
            <th>Aksi</th>
            <th>Pelamar</th>
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
            <td>{{ $job->postedBy?->name }}</td>
            <td>
                <a href="{{ route('admin.jobs.edit', $job) }}">Edit</a>
                <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus job ini?')">Hapus</button>
                </form>
            </td>
            <td>{{ $job->applications_count }}</td>
<td>
    <a href="{{ route('admin.jobs.applications', $job) }}">Lihat Pelamar</a> |
    <a href="{{ route('admin.jobs.edit', $job) }}">Edit</a>
    <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Hapus job ini?')">Hapus</button>
    </form>
</td>

        </tr>
    @empty
        <tr>
            <td colspan="10">Belum ada job.</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $jobs->links() }}

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>
