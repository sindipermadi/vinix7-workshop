<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorSchedule;
use App\Models\MentoringSession;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // list semua slot available
    public function index()
    {
        $schedules = MentorSchedule::with('mentor')
            ->where('status', 'available')
            ->orderBy('start_at')
            ->get();

        return view('student.schedule.index', compact('schedules'));
    }

    // form booking (isi goal & topic)
    public function showBookForm(MentorSchedule $schedule)
    {
        $user = auth()->user();

        if ($user->role !== 'student') {
            abort(403);
        }

        if ($schedule->status !== 'available') {
            return redirect()
                ->route('student.schedule.index')
                ->with('error', 'Slot tidak tersedia lagi.');
        }

        return view('student.schedule.book', compact('schedule'));
    }

    // proses booking
    public function book(Request $request, MentorSchedule $schedule)
    {
        $user = $request->user();

        if ($user->role !== 'student') {
            abort(403);
        }

        if ($schedule->status !== 'available') {
            return redirect()
                ->route('student.schedule.index')
                ->with('error', 'Slot tidak tersedia lagi.');
        }

        $request->validate([
            'goal'  => ['required', 'string', 'max:255'],
            'topic' => ['required', 'string', 'max:255'],
        ]);

        // buat sesi mentoring
        $session = MentoringSession::create([
            'student_id'   => $user->id,
            'mentor_id'    => $schedule->mentor_id,
            'goal'         => $request->goal,
            'topic'        => $request->topic,
            'scheduled_at' => $schedule->start_at,
            'status'       => 'pending',
            'notes'        => null,
        ]);

        // update schedule
        $schedule->update([
            'status'               => 'booked',
            'mentoring_session_id' => $session->id,
        ]);

        return redirect()
            ->route('student.mentoring.index')
            ->with('success', 'Mentoring berhasil dibooking.');
    }
}
