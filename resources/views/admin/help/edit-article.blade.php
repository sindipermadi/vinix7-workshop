
<div class="container">
    <h1 class="mb-4">Edit Artikel</h1>

    <form action="{{ route('admin.help.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label class="form-label">Judul Artikel</label>
            <input
                type="text"
                name="title"
                class="form-control"
                value="{{ old('title', $article->title) }}"
                required
            >
        </div>

        {{-- Isi --}}
        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea
                name="content"
                class="form-control"
                rows="7"
                required
            >{{ old('content', $article->content) }}</textarea>
        </div>

        {{-- Tags --}}
        <div class="mb-3">
            <label class="form-label">Tags (pisahkan dengan koma)</label>
            <input
                type="text"
                name="tags"
                class="form-control"
                value="{{ old('tags', $article->tags) }}"
                placeholder="contoh: akun, login, reset password"
            >
        </div>

        <button class="btn btn-primary">Update Artikel</button>
        <a href="{{ route('admin.help.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
