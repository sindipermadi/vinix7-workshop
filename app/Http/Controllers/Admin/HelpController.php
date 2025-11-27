<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpArticle;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    // halaman utama help center (daftar kategori)
    public function index()
    {
        $articles = HelpArticle::orderByDesc('created_at')->get();
        return view('admin.help.index', compact('articles'));
    }


    // form tambah artikel
    public function createArticle()
    {
        return view('admin.help.create-article');
    }


    public function show(HelpArticle $article)
    {
        return view('help.show', compact('article'));
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'tags'    => 'nullable|string'
        ]);


        HelpArticle::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'tags'=> $request->tags,
        ]);

        return redirect()->route('admin.help.index')->with('success', 'Artikel help berhasil ditambahkan.');
    }

    // edit artikel
    public function editArticle(HelpArticle $article)
    {
        return view('admin.help.edit-article', compact('article'));
    }

    public function updateArticle(Request $request, HelpArticle $article)
    {
        $request->validate([
            'title'   => 'required|string',
            'content' => 'required|string',
            'tags'    => 'nullable|string'
        ]);

        $article->update($request->only('title', 'content', 'tags'));

      return redirect()->route('admin.help.index')->with('success', 'Artikel help berhasil diupdate.');
    }

    // hapus artikel
    public function deleteArticle(HelpArticle $article)
    {
        $article->delete();

        return back()->with('success', 'Artikel help dihapus.');
    }
}
