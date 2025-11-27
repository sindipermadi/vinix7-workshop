<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentoringSession;
use App\Models\User;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    // list sesi mentoring milik mahasiswa
    public function index()
    {
        $sessions = MentoringSession::with('mentor')
            ->where('student_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('student.mentoring.index', compact('sessions'));
    }

    public function create()
    {
        $mentors = User::where('role', User::ROLE_MENTOR)->get();

        return view('student.mentoring.create', compact('mentors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mentor_id'    => ['required', 'exists:users,id'],
            'goal'         => ['required', 'string', 'max:255'],
            'topic'        => ['required', 'string', 'max:255'],
            'scheduled_at' => ['nullable', 'date'],
        ]);

        MentoringSession::create([
            'student_id'   => auth()->id(),
            'mentor_id'    => $request->mentor_id,
            'goal'         => $request->goal,
            'topic'        => $request->topic,
            'scheduled_at' => $request->scheduled_at,
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('student.mentoring.index')
            ->with('success', 'Mentoring request created.');
    }
}
