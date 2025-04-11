<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $article1 = Article::create([
            'title' => 'Le sport en 2024',
            'content' => 'Les JO arrivent à Paris, une année sportive incroyable.',
            'category_id' => 1, // Sport
        ]);

        $article2 = Article::create([
            'title' => 'L’IA dans la vie quotidienne',
            'content' => 'Comment l’intelligence artificielle transforme nos foyers.',
            'category_id' => 2, // Technologie
        ]);

        $article3 = Article::create([
            'title' => 'Top 5 des recettes faciles',
            'content' => 'Découvrez des recettes simples et délicieuses pour tous les jours.',
            'category_id' => 3, // Cuisine
        ]);

        // 🔗 Association des mots-clés aux articles
        $article1->keywords()->attach([1]); // écologie
        $article2->keywords()->attach([2]); // innovation
        $article3->keywords()->attach([3]); // recette
    }
}
