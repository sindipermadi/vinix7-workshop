<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // LIST SEMUA THREAD UNTUK MENTOR
    public function index()
    {
        $threads = ForumThread::with('user', 'category')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('mentor.forum.index', compact('threads'));
    }

    // DETAIL THREAD + SEMUA REPLIES
    public function show(ForumThread $thread)
    {
        $replies = $thread->replies()
            ->with('user')
            ->orderBy('created_at')
            ->get();

        return view('mentor.forum.show', compact('thread', 'replies'));
    }

    // MENTOR BALAS THREAD
    public function reply(Request $request, ForumThread $thread)
    {
        $data = $request->validate([
            'body' => ['required', 'string'],
        ]);

        ForumReply::create([
            'thread_id' => $thread->id,
            'user_id'   => $request->user()->id,
            'body'      => $data['body'],
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    // TANDAI SALAH SATU REPLY SEBAGAI SOLUSI
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
