<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Mentoring</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background: #eee; }
        h1, h2, h3 { margin: 0 0 10px 0; }
        .header { margin-bottom: 20px; }
    </style>
</head>
<body onload="window.print()">

<div class="header">
    <h2>Laporan Sesi Mentoring</h2>
    <p>Tanggal cetak: {{ now()->format('d-m-Y H:i') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Student</th>
            <th>Mentor</th>
            <th>Goal</th>
            <th>Topic</th>
            <th>Jadwal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($sessions as $session)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $session->student?->name }}</td>
            <td>{{ $session->mentor?->name }}</td>
            <td>{{ $session->goal }}</td>
            <td>{{ $session->topic }}</td>
            <td>{{ optional($session->scheduled_at)->format('d-m-Y H:i') }}</td>
            <td>{{ strtoupper($session->status) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7">Belum ada data.</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
