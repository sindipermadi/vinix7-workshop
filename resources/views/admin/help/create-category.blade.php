
<div class="container">
    <h1 class="mb-4">Tambah Kategori</h1>

    <form action="{{ route('admin.help.category.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
