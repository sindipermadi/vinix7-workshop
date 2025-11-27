<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Forum</title>
</head>
<body>

<h1>Tambah Kategori Forum</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.forum-categories.store') }}">
    @csrf

    <div>
        <label>Nama Kategori</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <br>
    <button type="submit">Simpan</button>
</form>

<p>
    <a href="{{ route('admin.forum-categories.index') }}">← Kembali ke daftar kategori</a>
</p>

</body>
</html>
