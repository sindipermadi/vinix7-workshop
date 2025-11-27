<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori Forum</title>
</head>
<body>

<h1>Edit Kategori Forum</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.forum-categories.update', $forumCategory) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Nama Kategori</label><br>
        <input type="text" name="name" value="{{ old('name', $forumCategory->name) }}" required>
    </div>

    <br>
    <button type="submit">Update</button>
</form>

<p>
    <a href="{{ route('admin.forum-categories.index') }}">← Kembali ke daftar kategori</a>
</p>

</body>
</html>
