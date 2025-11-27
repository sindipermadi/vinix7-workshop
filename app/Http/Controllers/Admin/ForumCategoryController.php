<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use Illuminate\Http\Request;

class ForumCategoryController extends Controller
{
    // LIST SEMUA KATEGORI
    public function index()
    {
        $categories = ForumCategory::orderBy('name')->get();

        return view('admin.forum.categories.index', compact('categories'));
    }

    // FORM BUAT KATEGORI
    public function create()
    {
        return view('admin.forum.categories.create');
    }

    // SIMPAN KATEGORI BARU
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        ForumCategory::create($data);

        return redirect()
            ->route('admin.forum-categories.index')
            ->with('success', 'Kategori forum berhasil dibuat.');
    }

    // FORM EDIT
    public function edit(ForumCategory $forumCategory)
    {
        return view('admin.forum.categories.edit', compact('forumCategory'));
    }

    // UPDATE KATEGORI
    public function update(Request $request, ForumCategory $forumCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $forumCategory->update($data);

        return redirect()
            ->route('admin.forum-categories.index')
            ->with('success', 'Kategori forum berhasil diperbarui.');
    }

    // HAPUS KATEGORI
    public function destroy(ForumCategory $forumCategory)
    {
        // opsional: bisa dicek apakah masih dipakai thread atau tidak
        $forumCategory->delete();

        return redirect()
            ->route('admin.forum-categories.index')
            ->with('success', 'Kategori forum berhasil dihapus.');
    }
}
