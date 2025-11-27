<h2>Forum Diskusi (Mentor)</h2>

{{-- nanti kalau mau mentor bisa buat thread sendiri, kita tambah tombol di sini --}}

@foreach ($threads as $t)
    <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
        <a href="{{ route('mentor.forum.show', $t->id) }}">
            <strong>{{ $t->title }}</strong>
        </a>
        <p>Kategori: {{ $t->category->name }}</p>
        <p>Oleh: {{ $t->user->name }}</p>
        <p>Status: {{ $t->status }}</p>
    </div>
@endforeach

{{ $threads->links() }}
