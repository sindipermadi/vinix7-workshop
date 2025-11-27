
<div class="container">
    <h1 class="mb-4">Help Center</h1>

    <a href="{{ route('admin.help.create') }}" class="btn btn-primary mb-3">
        + Tambah Artikel Baru
    </a>

    <div class="card">
        <div class="card-body">

                <ul class="list-group">
                    @foreach ($articles as $article)
                        <li class="list-group-item d-flex justify-content-between">
                            <a href="{{ route('admin.help.show', $article->id) }}">
                                {{ $article->title }}
                            </a>
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

                        </li>
                    @endforeach
                </ul>
        </div>
    </div>
</div>
