<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <x-guest-layout>
        <h1 class="font-bold text-xl mb-4">Liste des articles</h1>
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
            @foreach ($articles as $article)
                <li>
                    <a class="flex bg-white rounded-md shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
                        href="{{ route('front.articles.show', $article) }}">
                        {{ $article->title }}
                    </a>
                    <img src="{{ Storage::url($article->img_path) }}" alt="illustration de l'article">
                </li>
            @endforeach
        </ul>
<!--$articles est une instance de LengthAwarePaginator, retournée quand tu utilises .paginate() dans ton contrôleur (ex: Article::paginate(10))
->links() génère le HTML des boutons de navigation (Précédent / Numéros de pages / Suivant)-->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </x-guest-layout>
</body>
</html>