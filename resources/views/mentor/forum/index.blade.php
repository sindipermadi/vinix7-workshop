<h2>Forum Diskusi (Mentor)</h2>

{{-- FORM FILTER --}}
<form method="GET" action="">
    <label>Kategori:</label>
    <select name="category">
        <option value="">Semua</option>
        @foreach ($categories as $c)
            <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>

    <label>Status:</label>
    <select name="status">
        <option value="">Semua</option>
        <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Open</option>
        <option value="solved" {{ request('status')=='solved' ? 'selected' : '' }}>Solved</option>
    </select>

    <label>Cari:</label>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Judul thread...">

    <button type="submit">Filter</button>
</form>

<hr>

@foreach ($threads as $t)
    <div style="padding:10px; border:1px solid #ccc; margin:10px 0;">
        <a href="{{ route('mentor.forum.show', $t->id) }}">
            <strong>
                {{ $t->title }}
                @if($t->status=='solved')
                    <span style="color:green;">[SOLVED]</span>
                @endif
            </strong>
        </a>
        <p>Kategori: {{ $t->category->name }}</p>
        <p>Oleh: {{ $t->user->name }}</p>
    </div>
@endforeach

{{ $threads->links() }}
