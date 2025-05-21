<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            [
                'name' => 'Poción de Vida',
                'description' => 'Restaura 20 puntos de vida al instante.',
                'image_url' => 'images/potion_life.png',
                'stat_target' => 'health',
                'stat_bonus' => 20,
                'price' => 20,
                'type' => 'potion'
            ],
            [
                'name' => 'Escudo de Doran',
                'description' => 'Aumenta tu defensa en +1.',
                'image_url' => 'images/Escudo_Doran.png',
                'stat_target' => 'defensa',
                'stat_bonus' => 2,
                'price' => 25,
                'type' => 'equipment'
            ],
            [
                'name' => 'Anillo de Doran',
                'description' => 'Aumenta tu inteligencia en +1.',
                'image_url' => 'images/Anillo_Doran.png',
                'stat_target' => 'inteligencia',
                'stat_bonus' => 2,
                'price' => 25,
                'type' => 'equipment'

            ],
            [
                'name' => 'Capitulo perdido',
                'description' => 'Aumenta tu inteligencia en +3.',
                'image_url' => 'images/capitulo_perdido.png',
                'stat_target' => 'inteligencia',
                'stat_bonus' => 3,
                'price' => 45,
                'type' => 'equipment'

            ],
            [
                'name' => 'Cristal de rubí',
                'description' => 'Aumenta tu fuerza en +3.',
                'image_url' => 'images/cristal_rubi.png',
                'stat_target' => 'fuerza',
                'stat_bonus' => 3,
                'price' => 45,
                'type' => 'equipment'

            ],
            [
                'name' => 'Cota de mallas',
                'description' => 'Aumenta tu defensa en +3.',
                'image_url' => 'images/cota_mallas.png',
                'stat_target' => 'defensa',
                'stat_bonus' => 3,
                'price' => 45,
                'type' => 'equipment'

            ],
            [
                'name' => 'Poción reutilizable',
                'description' => 'Restaura 50 puntos de vida al instante.',
                'image_url' => 'images/Pocion_reutilizable.png',
                'stat_target' => 'health',
                'stat_bonus' => 50,
                'price' => 65,
                'type' => 'potion'

            ],
            [
                'name' => 'Poción de corrupción',
                'description' => 'Restaura 100 puntos de vida al instante.',
                'image_url' => 'images/pocion_corrupcion.png',
                'stat_target' => 'health',
                'stat_bonus' => 100,
                'price' => 90,
                'type' => 'potion'

            ],
            [
                'name' => 'Sombrero de Rabadon',
                'description' => 'Aumenta tu inteligencia en +10.',
                'image_url' => 'images/sombrero_rabadon.png',
                'stat_target' => 'inteligencia',
                'stat_bonus' => 10,
                'price' => 100,
                'type' => 'equipment'

            ],
            [
                'name' => 'Armadura de Warmog',
                'description' => 'Aumenta tu fuerza en +10.',
                'image_url' => 'images/warmog.png',
                'stat_target' => 'fuerza',
                'stat_bonus' => 10,
                'price' => 100,
                'type' => 'equipment'

            ],
            [
                'name' => 'Cota de espinas',
                'description' => 'Aumenta tu defensa en +10.',
                'image_url' => 'images/cota_espinas.png',
                'stat_target' => 'defensa',
                'stat_bonus' => 10,
                'price' => 100,
                'type' => 'equipment'

            ], 
            [
                'name' => 'Mejora de experiencia',
                'description' => 'Aumenta tu experiencia en +50.',
                'image_url' => 'images/xp_bonus.png',
                'stat_target' => 'experiencia',
                'stat_bonus' => 50,
                'price' => 100,
                'type' => 'equipment'

            ],

        ]);
    }
}
