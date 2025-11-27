<?php

use Illuminate\Support\Facades\Route;

// CONTROLLERS
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MentoringController as AdminMentoringController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\ForumCategoryController as AdminForumCategoryController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\HelpViewerController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\MentoringController as StudentMentoringController;
use App\Http\Controllers\Student\ScheduleController as StudentScheduleController;
use App\Http\Controllers\Student\JobController as StudentJobController;
use App\Http\Controllers\Student\ForumController as StudentForumController;

use App\Http\Controllers\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\Mentor\MentoringController as MentorMentoringController;
use App\Http\Controllers\Mentor\ScheduleController as MentorScheduleController;


// =========================
//  ROOT PAGE
// =========================
Route::get('/', function () {
    return view('welcome');
});

// Auth Breeze
require __DIR__.'/auth.php';


// =========================
//  REDIRECT SETELAH LOGIN
// =========================
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'mentor'  => redirect()->route('mentor.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default   => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');



// ======================================================================
//  ADMIN ROUTES
// ======================================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Mentoring Admin
    Route::get('/mentoring', [AdminMentoringController::class, 'index'])->name('mentoring.index');
    Route::get('/mentoring/print', [AdminMentoringController::class, 'print'])->name('mentoring.print');
    Route::get('/mentoring/pdf', [AdminMentoringController::class, 'pdf'])->name('mentoring.pdf');

    // CRUD Jobs
    Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [AdminJobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [AdminJobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [AdminJobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [AdminJobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');

    // Pelamar
    Route::get('/jobs/{job}/applications', [AdminJobController::class, 'applications'])->name('jobs.applications');
    Route::put('/jobs/{job}/applications/{application}', [AdminJobController::class, 'updateApplication'])->name('jobs.applications.update');

    // ============================
    // 🎯 FORUM CATEGORIES (ADMIN)
    // ============================
    Route::get('/forum-categories', [AdminForumCategoryController::class, 'index'])->name('forum-categories.index');
    Route::get('/forum-categories/create', [AdminForumCategoryController::class, 'create'])->name('forum-categories.create');
    Route::post('/forum-categories', [AdminForumCategoryController::class, 'store'])->name('forum-categories.store');
    Route::get('/forum-categories/{forumCategory}/edit', [AdminForumCategoryController::class, 'edit'])->name('forum-categories.edit');
    Route::put('/forum-categories/{forumCategory}', [AdminForumCategoryController::class, 'update'])->name('forum-categories.update');
    Route::delete('/forum-categories/{forumCategory}', [AdminForumCategoryController::class, 'destroy'])->name('forum-categories.destroy');
Route::prefix('help')->name('help.')->group(function () {

    Route::get('/', [HelpController::class, 'index'])->name('index');


    Route::get('/create', [HelpController::class, 'createArticle'])->name('create');
    Route::post('/store', [HelpController::class, 'storeArticle'])->name('store');
    Route::get('/{article}/show', [HelpController::class, 'show'])->name('show');

    Route::get('/article/{article}/edit', [HelpController::class, 'editArticle'])->name('edit');
    Route::put('/article/{article}', [HelpController::class, 'updateArticle'])->name('update');
    Route::delete('/article/{article}', [HelpController::class, 'deleteArticle'])->name('delete');
});

});



// ======================================================================
//  STUDENT ROUTES
// ======================================================================
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // Mentoring
    Route::get('/mentoring', [StudentMentoringController::class, 'index'])->name('mentoring.index');
    Route::get('/mentoring/create', [StudentMentoringController::class, 'create'])->name('mentoring.create');
    Route::post('/mentoring', [StudentMentoringController::class, 'store'])->name('mentoring.store');

    // Schedule
    Route::get('/schedule', [StudentScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/{schedule}/book', [StudentScheduleController::class, 'showBookForm'])->name('schedule.book.form');
    Route::post('/schedule/{schedule}/book', [StudentScheduleController::class, 'book'])->name('schedule.book');

    // Jobs
    Route::get('/jobs', [StudentJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [StudentJobController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{job}/apply', [StudentJobController::class, 'apply'])->name('jobs.apply');
    Route::get('/applications', [StudentJobController::class, 'applications'])->name('jobs.applications');

    // ============================
    // 🎯 FORUM (STUDENT)
    // ============================
    Route::prefix('forum')->name('forum.')->group(function () {
        Route::get('/', [StudentForumController::class, 'index'])->name('index');
        Route::get('/create', [StudentForumController::class, 'create'])->name('create');
        Route::post('/store', [StudentForumController::class, 'store'])->name('store');
        Route::get('/thread/{thread}', [StudentForumController::class, 'show'])->name('show');
        Route::post('/thread/{thread}/reply', [StudentForumController::class, 'reply'])->name('reply');
        Route::put('/thread/{thread}/reply/{reply}/mark-solution', [\App\Http\Controllers\Student\ForumController::class, 'markSolution'])->name('mark-solution');

    });

// Help Viewer (Student & Mentor & Admin)
Route::prefix('help')->name('help.')->group(function () {
    Route::get('/', [HelpViewerController::class, 'index'])->name('index');
    Route::get('/category/{category}', [HelpViewerController::class, 'showCategory'])->name('category');
    Route::get('/article/{article}', [HelpViewerController::class, 'show'])->name('show');
    Route::get('/{tag}/tag', [HelpViewerController::class, 'showTag'])->name('tag');
});
});




// ======================================================================
//  MENTOR ROUTES
// ======================================================================
Route::middleware(['auth', 'role:mentor'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [MentorDashboardController::class, 'index'])->name('dashboard');

    // Mentoring
    Route::get('/mentoring', [MentorMentoringController::class, 'index'])->name('mentoring.index');
    Route::get('/mentoring/{session}/edit', [MentorMentoringController::class, 'edit'])->name('mentoring.edit');
    Route::put('/mentoring/{session}', [MentorMentoringController::class, 'update'])->name('mentoring.update');

    // Schedule
    Route::get('/schedule', [MentorScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/create', [MentorScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [MentorScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{schedule}/edit', [MentorScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedule/{schedule}', [MentorScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}', [MentorScheduleController::class, 'destroy'])->name('schedule.destroy');

    // ============================
    // 🎯 FORUM (MENTOR)
    // ============================
    Route::prefix('forum')->name('forum.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Mentor\ForumController::class, 'index'])->name('index');
    Route::get('/thread/{thread}', [\App\Http\Controllers\Mentor\ForumController::class, 'show'])->name('show');
    Route::post('/thread/{thread}/reply', [\App\Http\Controllers\Mentor\ForumController::class, 'reply'])->name('reply');
    // Route::post('/thread/{thread}/reply/{reply}/mark-solution', [\App\Http\Controllers\Mentor\ForumController::class, 'markSolution'])->name('mark-solution');
    });
// HELP VIEWER FOR ALL ROLES
Route::prefix('help')->name('help.')->group(function () {
    Route::get('/', [HelpViewerController::class, 'index'])->name('index');
    Route::get('/category/{category}', [HelpViewerController::class, 'showCategory'])->name('category');
    Route::get('/article/{article}', [HelpViewerController::class, 'show'])->name('show');
    Route::get('/{tag}/tag', [HelpViewerController::class, 'showTag'])->name('tag');

});
});
