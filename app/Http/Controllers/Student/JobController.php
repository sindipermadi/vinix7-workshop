<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // === LIST JOBS UNTUK STUDENT ===
    public function index()
    {
        $jobs = Job::where('status', 'active')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('student.jobs.index', compact('jobs'));
    }

    // === DETAIL JOB ===
public function show(Job $job)
{
    $user = auth()->user();

    $application = JobApplication::where('student_id', $user->id)
        ->where('job_id', $job->id)
        ->first();

    return view('student.jobs.show', [
        'job'         => $job,
        'applied'     => (bool) $application,
        'appStatus'   => $application?->status,
        'application' => $application,
    ]);
}


    // === APPLY JOB ===
    public function apply(Request $request, Job $job)
    {
        $user = $request->user();

        if ($user->role !== 'student') {
            abort(403);
        }

        if ($job->status !== 'active') {
            return redirect()
                ->route('student.jobs.show', $job)
                ->with('error', 'Job ini sudah tidak aktif.');
        }

        $request->validate([
            'cover_letter' => ['nullable', 'string'],
        ]);

        $existing = JobApplication::where('student_id', $user->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existing) {
            return redirect()
                ->route('student.jobs.show', $job)
                ->with('error', 'Kamu sudah melamar job ini.');
        }

        JobApplication::create([
            'student_id'   => $user->id,
            'job_id'       => $job->id,
            'cover_letter' => $request->cover_letter,
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('student.jobs.applications')
            ->with('success', 'Lamaran berhasil dikirim.');
    }

    // === DAFTAR LAMARAN SAYA ===
    public function applications()
    {
        $apps = JobApplication::with('job')
            ->where('student_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('student.jobs.applications', compact('apps'));
    }
}
