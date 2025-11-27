<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelamar - {{ $job->title }}</title>
</head>
<body>
<h1>Pelamar untuk: {{ $job->title }}</h1>

<p>
    <a href="{{ route('admin.jobs.index') }}">← Kembali ke daftar Jobs</a>
</p>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Email</th>
            <th>Dilamar pada</th>
            <th>Cover Letter</th>
            <th>Status</th>
            <th>Catatan Admin</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
    @forelse($applications as $app)
        <tr>
            <td>{{ $app->id }}</td>
            <td>{{ $app->student?->name }}</td>
            <td>{{ $app->student?->email }}</td>
            <td>{{ $app->created_at }}</td>
            <td style="max-width: 250px;">
                {{ $app->cover_letter }}
            </td>
            <td>
                <form method="POST" action="{{ route('admin.jobs.applications.update', [$job, $app]) }}">
                    @csrf
                    @method('PUT')

                    <select name="status">
                        <option value="pending"  @selected($app->status === 'pending')>Pending</option>
                        <option value="reviewed" @selected($app->status === 'reviewed')>Reviewed</option>
                        <option value="accepted" @selected($app->status === 'accepted')>Accepted</option>
                        <option value="rejected" @selected($app->status === 'rejected')>Rejected</option>
                    </select>
            </td>
            <td>
                    <textarea name="admin_note" rows="2" cols="25">{{ $app->admin_note }}</textarea>
            </td>
            <td>
                    <button type="submit">Simpan</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">Belum ada pelamar untuk job ini.</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
