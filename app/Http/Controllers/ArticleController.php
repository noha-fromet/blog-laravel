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

        return view('blog.index', compact('articles'));
    }

    // Afficher le formulaire de création d'un article
    public function create()
    {
        $categories = Category::all();
        $keywords = Keyword::all();

        // Aucune variable $article nécessaire ici
        return view('articles.create', compact('categories', 'keywords'));
    }

    // Enregistrer un nouvel article
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'keywords' => 'nullable|array',
            'keywords.*' => 'exists:keywords,id',
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        if ($request->has('keywords')) {
            $article->keywords()->sync($validated['keywords']);
        }

        return redirect()->route('home')->with('success', 'Article créé avec succès');
    }

    public function createKeyword(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:keywords,name|max:255',
        ]);

        $keyword = Keyword::create([
            'name' => $validated['name'],
        ]);

        $keywords = Keyword::all();

        return redirect()->route('articles.create')->with([
            'success' => 'Mot-clé créé avec succès',
            'keywords' => $keywords,
        ]);
    }

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

    // Suppression d'un article
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
    }

    // Afficher le formulaire d’édition
    public function edit(Article $article)
    {
        $categories = Category::all();
        $keywords = Keyword::all();
        return view('articles.edit', compact('article', 'categories', 'keywords'));
    }

    // Mettre à jour l’article
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'keywords' => 'nullable|array',
            'keywords.*' => 'exists:keywords,id',
        ]);

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        if ($request->has('keywords')) {
            $article->keywords()->sync($validated['keywords']);
        } else {
            $article->keywords()->detach(); // Enlever les anciens mots-clés
        }

        return redirect()->route('articles.index')->with('success', 'Article modifié avec succès');
    }
}
