<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MentorSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // list semua slot mentor yang login
    public function index()
    {
        $schedules = MentorSchedule::where('mentor_id', auth()->id())
            ->orderBy('start_at')
            ->get();

        return view('mentor.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('mentor.schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_at' => ['required', 'date'],
            'end_at'   => ['required', 'date', 'after:start_at'],
        ]);

        MentorSchedule::create([
            'mentor_id' => auth()->id(),
            'start_at'  => $request->start_at,
            'end_at'    => $request->end_at,
            'status'    => 'available',
        ]);

        return redirect()
            ->route('mentor.schedule.index')
            ->with('success', 'Schedule slot created.');
    }

    public function edit(MentorSchedule $schedule)
    {
        // keamanan: harus milik mentor yang login
        if ($schedule->mentor_id !== auth()->id()) {
            abort(403);
        }

        return view('mentor.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, MentorSchedule $schedule)
    {
        if ($schedule->mentor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'start_at' => ['required', 'date'],
            'end_at'   => ['required', 'date', 'after:start_at'],
            'status'   => ['required', 'in:available,booked,canceled'],
        ]);

        $schedule->update([
            'start_at' => $request->start_at,
            'end_at'   => $request->end_at,
            'status'   => $request->status,
        ]);

        return redirect()
            ->route('mentor.schedule.index')
            ->with('success', 'Schedule updated.');
    }

    public function destroy(MentorSchedule $schedule)
    {
        if ($schedule->mentor_id !== auth()->id()) {
            abort(403);
        }

        $schedule->delete();

        return redirect()
            ->route('mentor.schedule.index')
            ->with('success', 'Schedule deleted.');
    }
}
