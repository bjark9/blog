<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    // Définir la rélation entre Article et User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calcule le temps écoulé depuis la date de publication
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
