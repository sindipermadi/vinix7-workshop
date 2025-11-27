
<div class="container">
    <h1 class="mb-4">Kategori: {{ $category->name }}</h1>

    <a href="{{ route('admin.help.create', $category->id) }}" class="btn btn-primary mb-3">
        + Tambah Artikel
    </a>

    <div class="card">
        <div class="card-body">
            @if ($category->articles->count() == 0)
                <p class="text-muted">Belum ada artikel.</p>
            @else
                <ul class="list-group">
                    @foreach ($category->articles as $article)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $article->title }}</span>

                            <div>
                                <a href="{{ route('admin.help.edit', $article->id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.help.delete', $article->id) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Yakin hapus artikel ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
