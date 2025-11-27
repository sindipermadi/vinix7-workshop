<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // === LIST JOB ===
    public function index()
    {
        $jobs = Job::with('postedBy')
            ->withCount('applications')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    // === FORM BUAT JOB ===
    public function create()
    {
        return view('admin.jobs.create');
    }

    // === SIMPAN JOB BARU ===
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'company'      => ['nullable', 'string', 'max:255'],
            'location'     => ['nullable', 'string', 'max:255'],
            'job_type'     => ['required', 'in:full_time,part_time,internship,freelance'],
            'level'        => ['required', 'in:junior,mid,senior'],
            'description'  => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'salary_min'   => ['nullable', 'integer'],
            'salary_max'   => ['nullable', 'integer'],
            'deadline'     => ['nullable', 'date'],
            'status'       => ['required', 'in:active,closed'],
        ]);

        $data['posted_by'] = $request->user()->id;

        Job::create($data);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job berhasil dibuat.');
    }

    // === EDIT JOB ===
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    // === UPDATE JOB ===
    public function update(Request $request, Job $job)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'company'      => ['nullable', 'string', 'max:255'],
            'location'     => ['nullable', 'string', 'max:255'],
            'job_type'     => ['required', 'in:full_time,part_time,internship,freelance'],
            'level'        => ['required', 'in:junior,mid,senior'],
            'description'  => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'salary_min'   => ['nullable', 'integer'],
            'salary_max'   => ['nullable', 'integer'],
            'deadline'     => ['nullable', 'date'],
            'status'       => ['required', 'in:active,closed'],
        ]);

        $job->update($data);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job berhasil diperbarui.');
    }

    // === HAPUS JOB ===
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Job berhasil dihapus.');
    }

    // === LIST PELAMAR UNTUK 1 JOB ===
    public function applications(Job $job)
    {
        $applications = JobApplication::with('student')
            ->where('job_id', $job->id)
            ->orderByDesc('created_at')
            ->get();

        return view('admin.jobs.applications', compact('job', 'applications'));
    }

    // === UPDATE STATUS LAMARAN ===
    public function updateApplication(Request $request, Job $job, JobApplication $application)
    {
        if ($application->job_id !== $job->id) {
            abort(404);
        }

        $data = $request->validate([
            'status' => ['required', 'in:pending,reviewed,accepted,rejected'],
            'admin_note' => ['nullable', 'string'],
        ]);

        $application->update($data);

        return redirect()
            ->route('admin.jobs.applications', $job)
            ->with('success', 'Status lamaran diperbarui.');
    }
}
