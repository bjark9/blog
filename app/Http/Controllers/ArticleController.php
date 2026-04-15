<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles
     */
    public function index(Request $request)
    {
        $articles = Article::query()
            ->where('published_at', '<',now())
            ->when($request->query('search'), function ($query) use ($request) {
                $query->where('body', 'LIKE', '%'.$request->query('search').'%') // filtre les articles dont le texte contient la chaîne de caractères recherchée.
                ->orWhere('title', 'LIKE', '%'.$request->query('search').'%') // filtre les articles dont le titre contient la chaîne de caractères recherchée.
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->query('search').'%');
                }); // filtre les articles dont l'auteur contient la chaîne de caractères recherchée.
            })->orderBydesc('published_at')->paginate(12);

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
