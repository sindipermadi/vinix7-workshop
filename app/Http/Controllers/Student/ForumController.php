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
    public function index()
    {
        $threads = ForumThread::with('user', 'category')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('student.forum.index', compact('threads'));
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

        return view('student.forum.show', compact('thread', 'replies'));
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
}
