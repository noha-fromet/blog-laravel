<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    // Ajoute la propriété $fillable pour permettre l'assignation en masse du champ 'name'
    protected $fillable = ['name'];

    // Un mot-clé est lié à plusieurs articles
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
