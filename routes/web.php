<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ArticleController; // Ajout du contrôleur ArticleController

// Page d’accueil - liste de tous les articles
Route::get('/', [BlogController::class, 'index'])->name('home');

// Page : tous les articles d’une catégorie
Route::get('/categorie/{id}', [BlogController::class, 'showCategory'])->name('category');

// Page : détail d’un article
Route::get('/article/{id}', [BlogController::class, 'showArticle'])->name('article');

// Page : articles liés à un mot-clé
Route::get('/mot-cle/{id}', [BlogController::class, 'showKeyword'])->name('keyword');

// Route pour afficher le formulaire de création d'un article
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');

// Route pour enregistrer un nouvel article
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

// Route pour afficher la liste des articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Route pour creer un mot-cle depuis le site
Route::post('/articles/create-keyword', [ArticleController::class, 'createKeyword'])->name('articles.createKeyword');

// Route pour créer une nouvelle catégorie
Route::post('/articles/create-category', [ArticleController::class, 'createCategory'])->name('articles.createCategory'); // Ajout de la route pour créer une catégorie

// Route pour supprimer un article
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

// Route pour afficher le formulaire de modification d'un article
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

// Route pour mettre à jour un article
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');