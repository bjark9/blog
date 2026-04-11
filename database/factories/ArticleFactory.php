<?php
// Une Factory sert à générer des données fictives pour les test ou le seeding des bases de données.

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

/**
 * @extends Factory<Article>
 * Le fichier ArticlesTableSeeder.php va se baser sur ce Factory pour seed la bdd (en utilisant la commande: php artisan migrate:fresh --seed)
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     * Retourne un tableau associatif où chaque clé correspond à une ligne correspond à une colonne de la table "articles"
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->bs(), // Génére une titre aléatoire de type bs
            'body' => fake()->realTextBetween($minNbChars = 500, $maxNbChars = 2000),
            // Fonction anonyme
            'img_path' => function() {
                $randomName = Str::uuid(); // Génére un identifiant unique 
                $imageUrl = "https://picsum.photos/1024/768.webp?random={$randomName}";
                $path = "images/{$randomName}.webp"; // Définit le chemin local ou l'image sera sauvegardée
                Storage::disk('public')->put($path, file_get_contents($imageUrl));  // Télécharge l'image via picsum et la sauvegarde
                                                                                    // dans le stockage public de laravel (storage/app/public/images/)
                return $path; // Retourne le chemin qui sera stocké dans la bdd
            },
            'published_at' => fake()->dateTimeBetween('-2 months', '+ 1 month'),
            'user_id' => User::get()->random()->id,
        ];
    }
}
