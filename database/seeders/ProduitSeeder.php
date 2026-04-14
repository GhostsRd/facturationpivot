<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $produits = [
            [
                'name' => 'Laptop Gamer',
                'description' => 'Un ordinateur portable puissant pour les jeux vidéo.',
                'price' => 1499.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartphone Pro',
                'description' => 'Smartphone haut de gamme avec caméra 108MP.',
                'price' => 999.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Casque Audio',
                'description' => 'Casque sans fil avec réduction de bruit active.',
                'price' => 199.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('produits')->insert($produits);
    
    }
}
