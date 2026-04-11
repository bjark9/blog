<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles
     */
    public function index()
    {
        $articles = Article::paginate(12);

        return view('front.articles.index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Affiche les détails d'un article
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('front.articles.show', [
            'article' => $article,
        ]);
    }
}
