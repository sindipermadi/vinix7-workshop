<h2>{{ $thread->title }}</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<p><strong>Kategori:</strong> {{ $thread->category->name }}</p>
<p><strong>Dibuat oleh:</strong> {{ $thread->user->name }}</p>
<p><strong>Status thread:</strong> {{ $thread->status }}</p>

<p>{{ $thread->body }}</p>

<hr>

<h3>Balasan</h3>

@forelse ($replies as $r)
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
        <strong>{{ $r->user->name }}</strong>
        @if($r->is_solution)
            <span style="color: green; font-weight: bold;">[SOLUSI]</span>
        @endif
        <p>{{ $r->body }}</p>

        {{-- Tombol tandai sebagai solusi (hanya kalau belum solusi) --}}
        {{-- @if(! $r->is_solution)
            <form method="POST" action="{{ route('mentor.forum.mark-solution', [$thread->id, $r->id]) }}">
                @csrf
                <button type="submit">Tandai sebagai Solusi</button>
            </form>
        @endif --}}
    </div>
@empty
    <p>Belum ada balasan.</p>
@endforelse

<hr>

<h3>Balas Thread</h3>

<form method="POST" action="{{ route('mentor.forum.reply', $thread->id) }}">
    @csrf
    <textarea name="body" rows="3" required></textarea>
    <br><br>
    <button type="submit">Kirim Balasan</button>
</form>

<p>
    <a href="{{ route('mentor.forum.index') }}">← Kembali ke daftar thread</a>
</p>
