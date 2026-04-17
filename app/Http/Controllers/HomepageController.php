<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->where('published_at', '<', now())
            ->withCount('comments')
            ->orderByDesc('published_at')
            ->take(4)
            ->get()
        ;

        return view('homepage.index', [
            'articles' => $articles,
        ]);
    }

    public function aPropos()
    {
        return view('homepage.a_propos');
    }
}
