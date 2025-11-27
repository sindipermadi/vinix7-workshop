<h2>{{ $thread->title }}</h2>

<p><strong>Kategori:</strong> {{ $thread->category->name }}</p>
<p><strong>Oleh:</strong> {{ $thread->user->name }}</p>
<p>{{ $thread->body }}</p>

<hr>

<h3>Balasan</h3>

@forelse ($replies as $r)
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
        <strong>{{ $r->user->name }}</strong>
        @if($r->is_solution)
            <span style="color: green; font-weight:bold;">[SOLUSI]</span>
        @endif
        <p>{{ $r->body }}</p>
    </div>
@empty

    <p>Belum ada balasan.</p>
@endforelse

<hr>

<h3>Balas Thread</h3>
<form action="{{ route('student.forum.reply', $thread->id) }}" method="POST">
    @csrf
    <textarea name="body" rows="3" required></textarea><br><br>
    <button type="submit">Kirim</button>
</form>
