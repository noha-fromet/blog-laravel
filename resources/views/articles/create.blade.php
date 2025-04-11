@extends('layout')

@section('content')
    <div class="container">
        <h1 class="my-4">Créer un nouvel article</h1>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Affichage du message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire pour créer un article -->
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf <!-- Token CSRF pour la sécurité -->

            <!-- Champ catégorie -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie :<button type="button" class="btn btn-link mt-2" data-bs-toggle="modal"
                    data-bs-target="#createCategoryModal">Ajouter une nouvelle catégorie</button></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Choisir une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Champ mots-clés (existant et création) -->
            <div class="mb-3 d-flex justify-content-between">
                <div style="width: 48%; padding-right: 8px;">
                    <label for="keywords" class="form-label">Mots-clés existants :<button type="button" class="btn btn-link mt-2" data-bs-toggle="modal"
                        data-bs-target="#createKeywordModal">Ajouter un nouveau mot-clé</button></label>
                    <select id="keywords" name="keywords[]" class="form-select" multiple>
                        @foreach ($keywords as $keyword)
                            <option value="{{ $keyword->id }}" {{ in_array($keyword->id, old('keywords', [])) ? 'selected' : '' }}>
                                {{ $keyword->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Maintenez la touche CTRL (ou Cmd) pour sélectionner plusieurs mots-clés</small>
                </div>
            </div>

            <!-- Champ titre -->
            <div class="mb-3">
                <label for="title" class="form-label">Titre :</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required>
            </div>

            <!-- Champ contenu -->
            <div class="mb-3">
                <label for="content" class="form-label">Contenu :</label>
                <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <!-- Bouton de soumission pour l'article -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Créer l'article</button>
            </div>
        </form>

        <!-- Modal pour ajouter une catégorie -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCategoryModalLabel">Ajouter une nouvelle catégorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('articles.createCategory') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Nom de la catégorie :</label>
                                <input type="text" id="category_name" name="name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter la catégorie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour ajouter un mot-clé -->
        <div class="modal fade" id="createKeywordModal" tabindex="-1" aria-labelledby="createKeywordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('articles.createKeyword') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="keyword_name" class="form-label">Nom du mot-clé :</label>
                                <input type="text" id="keyword_name" name="name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter le mot-clé</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
