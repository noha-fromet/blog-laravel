@extends('layout')

@section('content')
    <h1 class="mb-4">Tous les articles</h1>

    @foreach($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                <p class="card-text">{{ Str::limit($article->content, 100) }}</p>

                <p class="text-muted">
                    Catégorie :
                    <a href="{{ route('category', $article->category->id) }}">
                        {{ $article->category->name }}
                    </a>
                </p>

                <!-- Affichage de la date de publication -->
                <p class="text-muted">Publié le : {{ $article->created_at->format('d M Y') }}</p>

                <!-- Affichage des mots-clés -->
                @if($article->keywords->isNotEmpty())
                    <p class="text-muted">Mots-clés :
                        @foreach($article->keywords as $keyword)
                            <a href="{{ route('keyword', $keyword->id) }}" class="badge bg-secondary">{{ $keyword->name }}</a>
                        @endforeach
                    </p>
                @endif

                <!-- Lien pour lire la suite de l'article -->
                <a href="{{ route('article', $article->id) }}" class="btn btn-primary">Lire la suite</a>

                <!-- Formulaire de suppression -->
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="mt-2"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection