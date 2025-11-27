<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentoringSession;
use Barryvdh\DomPDF\Facade\Pdf;

class MentoringController extends Controller
{
    public function index()
    {
        $sessions = MentoringSession::with(['student', 'mentor'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.mentoring.index', compact('sessions'));
    }

    public function print()
    {
        $sessions = MentoringSession::with(['student', 'mentor'])
            ->orderBy('mentor_id')
            ->orderBy('scheduled_at')
            ->get();

        return view('admin.mentoring.print', compact('sessions'));
    }

    public function pdf()
    {
        $sessions = MentoringSession::with(['student', 'mentor'])
            ->orderBy('mentor_id')
            ->orderBy('scheduled_at')
            ->get();

        $pdf = Pdf::loadView('admin.mentoring.pdf', [
            'sessions' => $sessions,
            'generatedAt' => now(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-mentoring-'.now()->format('Ymd-His').'.pdf');
    }
}
