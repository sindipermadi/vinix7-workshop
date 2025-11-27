<div class="container">

    <a href="/admin/help" class="btn btn-secondary mb-3">← Kembali</a>

    <h1 class="mb-4">{{ $article->title }}</h1>

    <div class="card p-4">
        {!! nl2br(e($article->content)) !!}
    </div>
    @foreach (explode(',',$article->tags) as $tag)
        <a href="{{ route(Str::startsWith(request()->path(), 'student') ?
                'student.help.tag' : 'mentor.help.tag', $tag) }}"
            class="list-group-item list-group-item-action">{{ trim($tag) }}</a>
    @endforeach
</div>
