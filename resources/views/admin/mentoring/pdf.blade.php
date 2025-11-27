<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Mentoring</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 11px;
        }
        h1, h2, h3 {
            margin: 0 0 6px 0;
        }
        .header {
            margin-bottom: 12px;
            text-align: center;
        }
        .meta {
            margin-bottom: 10px;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN SESI MENTORING</h2>
        <p>VINIX7 Workshop</p>
    </div>

    <div class="meta">
        Tanggal cetak: {{ $generatedAt->format('d-m-Y H:i') }}<br>
        Total sesi: {{ $sessions->count() }}
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
        @forelse($sessions as $session)
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
                <td colspan="7">Belum ada data mentoring.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
