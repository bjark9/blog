<?php
    // php artisan make:controller Admin/ArticleController --resource --model=Article
    // --resource permet de rajouter les fonctions CRUD
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ?

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderByDesc('updated_at')->paginate(10);

        return view(
            'admin.articles.index',
            [
                'articles' => $articles,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCreateRequest $request)
    {
        // On crée un nouvel article
        $article = Article::make();

        // On ajoute les propriétés de l'article
        $article->title = $request->validated()['title'];
        $article->body = $request->validated()['body'];
        $article->published_at = $request->validated()['published_at'];
        $article->user_id = Auth::id();


        // Si il y a une image, on la sauvegarde
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('articles', 'public');
            $article->img_path = $path;
        }

        // On sauvegarde l'article en base de données
        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', ['article' => $article,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        // On modifies les propriétés de l'article
        $article->title = $request->validated()['title'];
        $article->body = $request->validated()['body'];
        $article->published_at = $request->validated()['published_at'];

        // Si il y a une image, on la sauvegarde
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('articles', 'public');
            $article->img_path = $path;
        }

        // On sauvegarde les modifications en base de données
        $article->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->back();
    }
}
