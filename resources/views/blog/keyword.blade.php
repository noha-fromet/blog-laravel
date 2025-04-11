@extends('layout')

@section('content')
    <h1 class="mb-4">Articles avec le mot-clé : {{ $keyword->name }}</h1>

    @forelse($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                <p class="card-text">{{ Str::limit($article->content, 100) }}</p>

                <p class="text-muted">Catégorie :
                    <a href="{{ route('category', $article->category->id) }}">
                        {{ $article->category->name }}
                    </a>
                </p>

                <a href="{{ route('article', $article->id) }}" class="btn btn-primary">Lire l'article</a>
            </div>
        </div>
    @empty
        <p>Aucun article trouvé avec ce mot-clé.</p>
    @endforelse

    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">← Retour à l'accueil</a>
@endsection