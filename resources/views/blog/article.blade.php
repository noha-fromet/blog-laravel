@extends('layout')

@section('content')
    <h1 class="mb-4">{{ $article->title }}</h1>

    <p class="text-muted">
        Catégorie :
        <a href="{{ route('category', $article->category->id) }}">
            {{ $article->category->name }}
        </a>
    </p>

    <p>{{ $article->content }}</p>

    <p class="mt-4">
        <strong>Mots-clés :</strong>
        @forelse ($article->keywords as $keyword)
            <a href="{{ route('keyword', $keyword->id) }}" class="badge bg-secondary text-decoration-none">
                {{ $keyword->name }}
            </a>
        @empty
            <span>Aucun mot-clé</span>
        @endforelse
    </p>

    <!-- Boutons Supprimer et Modifier -->
    <div class="mt-4">
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Es-tu sûr de vouloir supprimer cet article ?')">
                Supprimer cet article
            </button>
        </form>

        <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary ml-2">
            Modifier cet article
        </a>
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-4 d-inline-block">← Retour à l'accueil</a>
@endsection