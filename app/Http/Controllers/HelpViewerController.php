<?php

namespace App\Http\Controllers;

use App\Models\HelpCategory;
use App\Models\HelpArticle;
use Illuminate\Http\Request;

class HelpViewerController extends Controller
{
public function index(Request $request)
{
    $query = HelpArticle::query();

    if ($search = $request->q) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('content', 'LIKE', "%{$search}%");
        });
    }

    $articles = $query->orderBy('created_at', 'desc')->get();

    return view('help.index', compact('articles'));
}
public function showTag($tag, Request $request)
{

    $query = HelpArticle::where('tags', 'LIKE', "%{$tag}%")
        ->orderByDesc('created_at')
        ->get();

        if ($search = $request->q) {
       $query= $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('content', 'LIKE', "%{$search}%");
        });
    }
    return view('help.tags', ['articles' => $query, 'tag' => $tag]);
}



    public function show(HelpArticle $article)
    {
        return view('help.show', compact('article'));
    }
}
