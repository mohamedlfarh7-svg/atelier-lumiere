<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BouleDeNeige;
use App\Models\Nounours;
use App\Models\Parfum;
use App\Models\Cadeau;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        AdminSeeder::class,
    ]);
        // 1. Boules de Neige
        BouleDeNeige::insert([
            [
                'name' => 'Forêt Enchantée',
                'tag' => 'Grand',
                'price' => 349.00,
                'image' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1000',
                'description' => 'Boule de neige magique avec un cerf lumineux au cœur d’une forêt hivernale.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Nuit Étoilée',
                'tag' => 'Moyen',
                'price' => 269.00,
                'image' => 'https://images.unsplash.com/photo-1579202673506-ca3ce28943ef?q=80&w=1000',
                'description' => 'Un ciel étoilé capturé sous verre avec des reflets scintillants.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Douce Hiver',
                'tag' => 'Petite',
                'price' => 189.00,
                'image' => 'https://images.unsplash.com/photo-1543258103-a6dffc9c7f6b?q=80&w=1000',
                'description' => 'Une miniature féerique pour illuminer vos étagères.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Crystal Palace',
                'tag' => 'Grand',
                'price' => 399.00,
                'image' => 'https://images.unsplash.com/photo-1512389142860-9c449e58a543?q=80&w=1000',
                'description' => 'Édition limitée grand format avec flocons dorés.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // 2. Nounours
        Nounours::insert([
            [
                'name' => 'Amour Velours',
                'tag' => 'Coup de cœur',
                'price' => 199.00,
                'image' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?q=80&w=1000',
                'description' => 'Un ours en peluche ultra-doux avec un ruban satiné.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Câlin Miel',
                'tag' => 'Édition douce',
                'price' => 244.00,
                'image' => 'https://images.unsplash.com/photo-1534766555764-ce878a5e3a2b?q=80&w=1000',
                'description' => 'Peluche artisanale parfaite pour les nouveau-nés et les douceurs.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Teddy Blanc',
                'tag' => 'Coup de cœur',
                'price' => 219.00,
                'image' => 'https://images.unsplash.com/photo-1556012018-50fa5c015e4e?q=80&w=1000',
                'description' => 'Ours blanc pur, symbole de tendresse et de réconfort.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Petite Frimousse',
                'tag' => 'Édition douce',
                'price' => 159.00,
                'image' => 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?q=80&w=1000',
                'description' => 'Compagnon idéal aux yeux brillants et au pelage duveteux.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // 3. Parfums
        Parfum::insert([
            [
                'name' => 'Maison des Roses',
                'tag' => 'Femme',
                'price' => 650.00,
                'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=1000',
                'description' => 'Notes florales de mai mêlées à une touche de vanille poudrée.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Bois d’Orient',
                'tag' => 'Homme',
                'price' => 720.00,
                'image' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?q=80&w=1000',
                'description' => 'Un sillage intense boisé et épicé pour une signature unique.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Ambre Noir',
                'tag' => 'Homme',
                'price' => 690.00,
                'image' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1000',
                'description' => 'Alliance puissante d’ambre gris et de cuir noble.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Jardin Secret',
                'tag' => 'Femme',
                'price' => 590.00,
                'image' => 'https://images.unsplash.com/photo-1583445013765-46c20c4a6772?q=80&w=1000',
                'description' => 'Fraîcheur florale et agrumes pétillants.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // 4. Cadeaux
        Cadeau::insert([
            [
                'name' => 'Coffret Romance',
                'tag' => 'Romantique',
                'price' => 450.00,
                'image' => 'https://images.unsplash.com/photo-1513201099705-a9746e1e201f?q=80&w=1000',
                'description' => 'Coffret garni de roses éternelles et de chocolats fins.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Anniversaire Éclat',
                'tag' => 'Anniversaire',
                'price' => 380.00,
                'image' => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?q=80&w=1000',
                'description' => 'Bougie parfumée de luxe accompagnée d’une carte dorée.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Coffret Naissance Douceur',
                'tag' => 'Naissance',
                'price' => 420.00,
                'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?q=80&w=1000',
                'description' => 'Ensemble d’accessoires délicats pour bébé.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Boîte Merci',
                'tag' => 'Merci',
                'price' => 290.00,
                'image' => 'https://images.unsplash.com/photo-1526047932273-341f2a7631f9?q=80&w=1000',
                'description' => 'Une attention délicate pour exprimer votre gratitude.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}