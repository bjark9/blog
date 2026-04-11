<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $articles = Article::paginate(12);

        return view('homepage.index', ['articles'=>$articles]);
    }
}
