@extends('layout')

@section('content')
    <h1 class="mb-4">Modifier l'article</h1>

    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea name="content" id="content" rows="5"
                class="form-control">{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <select name="category_id" id="category" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Mots-clés</label>
            <div class="form-check">
                @foreach($keywords as $keyword)
                    <div>
                        <input type="checkbox" name="keywords[]" id="keyword_{{ $keyword->id }}" class="form-check-input"
                            value="{{ $keyword->id }}" {{ $article->keywords->contains($keyword->id) ? 'checked' : '' }}>
                        <label for="keyword_{{ $keyword->id }}" class="form-check-label">{{ $keyword->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('article', $article->id) }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection