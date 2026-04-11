<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-guest-layout>
        <h1 class="font-bold text-xl mb-4">Liste des articles</h1>
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
            @foreach ($articles as $article)
                <li>
                    <a class="flex bg-white rounded-md  shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
                        href="#">
                        {{ $article->title }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </x-guest-layout>
</body>
</html>