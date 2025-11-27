<div class="container">
    <h1 class="mb-4">Tambah Artikel </h1>

    <form action="{{ route('admin.help.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Artikel</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea name="content" class="form-control" rows="7" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags (pisahkan dengan koma)</label>
            <input
                type="text"
                name="tags"
                class="form-control"
                placeholder="contoh: akun, login, reset password"
            >
        </div>

        <button class="btn btn-success">Simpan Artikel</button>
    </form>
</div>
