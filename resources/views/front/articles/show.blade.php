<x-guest-layout>    
    <div class="flex justify-center">
        <form action="{{ route('front.articles.index') }}" method="get">
            <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" 
            type="submit">Homepage</button>
        </form>
    </div>
    <h1 class="font-bold text-xl mb-4 text-blue-500">{{ $article->title }}</h1>
    <img src="{{ Storage::url($article->img_path) }}" alt="illustration de l'article">
    <div class="mb-4 text-xs text-gray-500">
        {{ $article->published_at }}
    </div>
    <div class="text-blue-500">
        {!! \nl2br($article->body) !!}
    </div>
</x-guest-layout>