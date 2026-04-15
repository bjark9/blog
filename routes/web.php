<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

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

// 
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Gestion des articles (création, modification, suppression)
    Route::resource('/articles', AdminArticleController::class);

    // Gestion des utilisateurs (Détails et changement de rôle)
    Route::resource('/users', UserController::class);
});

Route::get('/a-propos', [HomepageController::class, 'aPropos'])->name('homepage.a_propos');

// Ajout de middleware 'auth' pour protèger l'accès a ces routes ainsi qu'un préfixe admin pour les routes de l'administration.
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('articles', AdminArticleController::class);
});

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // On ajoute la route pour la modification de l'avatar
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

require __DIR__.'/auth.php';
