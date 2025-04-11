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

    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">← Retour à l'accueil</a>
@endsection