<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MentoringSession;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    public function index()
    {
        $sessions = MentoringSession::with('student')
            ->where('mentor_id', auth()->id())
            ->orderBy('scheduled_at')
            ->get();

        return view('mentor.mentoring.index', compact('sessions'));
    }

    public function edit(MentoringSession $session)
    {
        // pastikan sesi ini milik mentor yang login
        if ($session->mentor_id !== auth()->id()) {
            abort(403);
        }

        return view('mentor.mentoring.edit', compact('session'));
    }

    public function update(Request $request, MentoringSession $session)
    {
        if ($session->mentor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => ['required', 'in:pending,approved,completed,canceled'],
            'notes'  => ['nullable', 'string'],
        ]);

        $session->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

        return redirect()
            ->route('mentor.mentoring.index')
            ->with('success', 'Session updated.');
    }
}
