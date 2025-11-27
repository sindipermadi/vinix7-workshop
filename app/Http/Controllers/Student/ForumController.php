<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // daftar semua thread
public function index(Request $request)
{
    $categories = \App\Models\ForumCategory::orderBy('name')->get();

    $threads = \App\Models\ForumThread::with('user', 'category')
        ->when($request->category, function ($q) use ($request) {
            $q->where('category_id', $request->category);
        })
        ->when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
        })
        ->when($request->search, function ($q) use ($request) {
            $q->where('title', 'LIKE', "%{$request->search}%");
        })
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString(); // agar pagination tetap bawa filter

    return view('student.forum.index', compact('threads', 'categories'));
}

    // form buat thread baru
    public function create()
    {
        $categories = ForumCategory::orderBy('name')->get();
        return view('student.forum.create', compact('categories'));
    }

    // simpan thread baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:forum_categories,id',
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $data['user_id'] = auth()->id();

        ForumThread::create($data);

        return redirect()
            ->route('student.forum.index')
            ->with('success', 'Thread berhasil dibuat.');
    }

    // tampilkan detail thread + balasan
    public function show(ForumThread $thread)
    {
        $replies = $thread->replies()
            ->with('user')
            ->orderBy('created_at')
            ->get();
        $solution = $replies->where('is_solution', true)->count();
        return view('student.forum.show', compact('thread', 'replies','solution'));
    }

    // kirim balasan
    public function reply(Request $request, ForumThread $thread)
    {
        $data = $request->validate([
            'body' => 'required|string',
        ]);

        ForumReply::create([
            'thread_id' => $thread->id,
            'user_id'   => auth()->id(),
            'body'      => $data['body'],
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }
   public function markSolution(ForumThread $thread, ForumReply $reply)
    {
        // keamanan: pastikan reply milik thread ini
        if ($reply->thread_id !== $thread->id) {
            abort(404);
        }

        // reset semua reply di thread ini jadi bukan solusi
        ForumReply::where('thread_id', $thread->id)
            ->update(['is_solution' => false]);

        // tandai reply ini sebagai solusi
        $reply->update(['is_solution' => true]);

        // ubah status thread jadi 'solved'
        $thread->update(['status' => 'solved']);

        return back()->with('success', 'Balasan ditandai sebagai solusi.');
    }
}
