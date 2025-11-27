<h2>Buat Thread Baru</h2>

<form method="POST" action="{{ route('student.forum.store') }}">
    @csrf

    <label>Kategori:</label>
    <select name="category_id" required>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Judul:</label>
    <input type="text" name="title" required>
    <br><br>

    <label>Isi Thread:</label>
    <textarea name="body" rows="4" required></textarea>
    <br><br>

    <button type="submit">POST</button>
</form>
