<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Keyword;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Afficher la page d'accueil avec la liste de tous les articles
    public function index()
    {
        $articles = Article::all();  // Récupérer tous les articles
        return view('blog.index', compact('articles'));  // Passer les articles à la vue
    }

    // Afficher les articles d'une catégorie spécifique
    public function showCategory($id)
    {
        $category = Category::findOrFail($id);  // Récupérer la catégorie
        $articles = $category->articles;  // Récupérer les articles de la catégorie
        return view('blog.category', compact('category', 'articles'));  // Passer les articles à la vue
    }

    // Afficher un article en détail
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);  // Récupérer l'article
        return view('blog.article', compact('article'));  // Passer l'article à la vue
    }

    // Afficher les articles associés à un mot-clé
    public function showKeyword($id)
    {
        $keyword = Keyword::findOrFail($id);  // Récupérer le mot-clé
        $articles = $keyword->articles;  // Récupérer les articles associés au mot-clé
        return view('blog.keyword', compact('keyword', 'articles'));  // Passer les articles à la vue
    }
}
