<div class="container">
    <h1 class="mb-4">Help Center</h1>

    <form method="GET" action="" class="mb-3">
        <input type="text"
               name="q"
               class="form-control"
               placeholder="Cari masalah atau kata kunci..."
               value="{{ request('q') }}">
    </form>

    @foreach($articles as $article)
        <a href="{{ route(Str::startsWith(request()->path(), 'student') ?
                'student.help.show' : 'mentor.help.show', $article->id) }}"
            class="list-group-item list-group-item-action">
            {{ $article->title }}
        </a>
    @endforeach
</div>
