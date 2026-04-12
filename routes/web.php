<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Modifier la route de base de Laravel pour qu'elle appelle notre méthode index
Route::get('/', [HomepageController::class, 'index']);

// Les routes avec ->name() en ont besoin parce qu'elles sont appelées quelque part avec route('nom') :
// La route / n'en a pas besoin parce qu'on l'appelle directement :
// php<a href="/">Accueil</a>
// ou
// return redirect('/');
Route::get('/articles', [ArticleController::class, 'index'])->name('front.articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('front.articles.show');

Route::get('/a-propos', [HomepageController::class, 'aPropos'])->name('homepage.a_propos');

require __DIR__.'/auth.php';
