<h1>Lamaran Saya</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="6" cellspacing="0">
<thead>
    <tr>
        <th>ID</th>
        <th>Job</th>
        <th>Company</th>
        <th>Applied At</th>
        <th>Status</th>
        <th>Keterangan / Catatan</th>
    </tr>
</thead>

<tbody>
@forelse($apps as $app)
    <tr>
        <td>{{ $app->id }}</td>
        <td>{{ $app->job?->title }}</td>
        <td>{{ $app->job?->company }}</td>
        <td>{{ $app->created_at }}</td>
        <td>{{ ucfirst($app->status) }}</td>
        <td style="max-width: 300px;">
            @if($app->admin_note)
                <div>{{ $app->admin_note }}</div>
            @else
                @if($app->status === 'pending')
                    <em>Menunggu review admin.</em>
                @elseif($app->status === 'reviewed')
                    <em>Sudah ditinjau. Tunggu instruksi lanjutan.</em>
                @elseif($app->status === 'accepted')
                    <em>Diterima. Cek detail job atau chat resmi untuk info lebih lanjut.</em>
                @elseif($app->status === 'rejected')
                    <em>Lamaran ditolak. Belum ada catatan tambahan.</em>
                @endif
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6">Kamu belum melamar job apa pun.</td>
    </tr>
@endforelse
</tbody>
</table>

<p><a href="{{ route('student.jobs.index') }}">Kembali ke Jobs</a></p>
