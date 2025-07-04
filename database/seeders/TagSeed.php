<?php

namespace Database\Seeders;

use App\Enums\TagEnum;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productTags = [
            'Oferta',
            'Nuevo',
            'Top Ventas',
            'Destacado',
            'Orgánico',
            'Vegano',
            'Sin Gluten',
            'Artesanal',
            'Importado',
            'Nacional',
            'Edición Limitada',
            'Eco-Friendly',
            'Reciclable',
            'Biodegradable',
            'Premium',
            'Básico',
            'Con Descuento',
            'Exclusivo Online',
            'Popular',
            'Colección',
            'Temporada',
            'Innovador',
            'Versátil',
            'Hecho a Mano',
            'Gourmet',
            'Electrónica',
            'Hogar',
            'Moda',
            'Belleza',
            'Salud',
            'Deportes',
            'Infantil',
            'Mascotas',
            'Libros',
            'Tecnología',
            'Accesorios',
            'Decoración',
            'Joyería',
            'Calzado',
            'Ropa',
            'Verano',
            'Invierno',
            'Regalo',
            'Económico',
            'Alta Calidad',
            'Personalizable',
            'Smart',
            'Inalámbrico',
            'Vintage',
            'Moderno',
            'Clásico',
            'Rústico',
            'Urbano',
            'Rural',
            'Outdoor',
            'Indoor'
        ];

        foreach ($productTags as $key => $value) {
            Tag::factory()->create([TagEnum::NAME => $value]);
        }
    }
}
