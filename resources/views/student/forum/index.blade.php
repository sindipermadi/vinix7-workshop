<h2>Forum Diskusi</h2>

<a href="{{ route('student.forum.create') }}">+ Buat Thread Baru</a>

@foreach ($threads as $t)
<div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
    <a href="{{ route('student.forum.show', $t->id) }}">
        <strong>{{ $t->title }}</strong>
    </a>
    <p>Kategori: {{ $t->category->name }}</p>
    <p>Oleh: {{ $t->user->name }}</p>
</div>
@endforeach

{{ $threads->links() }}
