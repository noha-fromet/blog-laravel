<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Keyword;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Afficher la liste des articles
    public function index()
    {
        $articles = Article::all();

        // Formater les dates des articles
        foreach ($articles as $article) {
            $article->formatted_date = $article->created_at->format('d M Y');
        }

        return view('blog.index', compact('articles')); // Affichage via la vue blog.index
    }

    // Afficher le formulaire de création d'un article
    public function create()
    {
        $categories = Category::all(); // Récupérer toutes les catégories
        $keywords = Keyword::all(); // Récupérer tous les mots-clés

        return view('articles.create', compact('categories', 'keywords')); // Passer les catégories et mots-clés à la vue
    }

    // Enregistrer un nouvel article
    public function store(Request $request)
    {
        // Validation des données de l'article
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'keywords' => 'nullable|array', // Validation pour les mots-clés
            'keywords.*' => 'exists:keywords,id', // Validation des mots-clés
        ]);

        // Créer l'article
        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        // Associer les mots-clés à l'article
        if ($request->has('keywords')) {
            $article->keywords()->sync($validated['keywords']);
        }

        return redirect()->route('home')->with('success', 'Article créé avec succès');
    }

    // Créer un nouveau mot-clé depuis le site
    public function createKeyword(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:keywords,name|max:255',
        ]);

        $keyword = Keyword::create([
            'name' => $validated['name'],
        ]);

        // Récupérer tous les mots-clés existants
        $keywords = Keyword::all();

        return redirect()->route('articles.create')->with([
            'success' => 'Mot-clé créé avec succès',
            'keywords' => $keywords,
        ]);
    }

    // Créer une nouvelle catégorie depuis le site
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
        ]);

        $category = Category::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('articles.create')->with('success', 'Catégorie créée avec succès');
    }
}
