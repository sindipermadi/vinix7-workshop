<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori Forum</title>
</head>
<body>

<h1>Daftar Kategori Forum</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<p>
    <a href="{{ route('admin.forum-categories.create') }}">+ Tambah Kategori</a>
</p>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Dibuat Pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->created_at }}</td>
            <td>
                <a href="{{ route('admin.forum-categories.edit', $cat) }}">Edit</a>

                <form action="{{ route('admin.forum-categories.destroy', $cat) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus kategori ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Belum ada kategori.</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>
    <a href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard Admin</a>
</p>

</body>
</html>
