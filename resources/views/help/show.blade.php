<div class="container">

    @if(auth()->user()->role=='admin')
    <a href="/admin/help" class="btn btn-secondary mb-3">← Kembali</a>
    @else
    <a href="{{ route(Str::startsWith(request()->path(), 'student') ?
                'student.help.index' : 'mentor.help.index')}}" class="btn btn-secondary mb-3">← Kembali</a>
    @endif

    <h1 class="mb-4">{{ $article->title }}</h1>

    <div class="card p-4">
        {!! nl2br(e($article->content)) !!}
    </div>
      @if($article->tags!="")
    @foreach (explode(',',$article->tags) as $tag)
        <a href="{{ route(Str::startsWith(request()->path(), 'student') ?
                'student.help.tag' : 'mentor.help.tag', $tag) }}"
            class="list-group-item list-group-item-action">{{ trim($tag) }}</a>
    @endforeach
    @endif
</div>
