<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Définir les attributs qui peuvent être attribués en masse (mass assignment)
    protected $fillable = ['title', 'content', 'category_id'];

    /**
     * Un article appartient à une catégorie.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);  // Relation inverse avec Category
    }

    /**
     * Un article a plusieurs mots-clés.
     */
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);  // Relation Many-to-Many avec Keyword
    }

    /**
     * Méthode pour effectuer des actions supplémentaires, comme une initialisation de valeur si nécessaire.
     */
    protected static function booted()
    {
        parent::boot();

        // Exemple : assigner un auteur par défaut (si la colonne 'user_id' existe dans ta table articles)
        static::creating(function ($article) {
            // Optionnel : tu peux assigner l'utilisateur actuel à un article si tu as une relation utilisateur
            // $article->user_id = auth()->id();  // Si tu veux assigner l'utilisateur connecté
        });

        // Tu peux aussi écouter d'autres événements comme la mise à jour ou la suppression
    }
}
