<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Enums\CategoryEnum;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesData = [
            [
                'name' => 'Electrónica',
                'subcategories' => [
                    ['name' => 'Smartphones'],
                    ['name' => 'Laptops'],
                    ['name' => 'Televisores'],
                    ['name' => 'Audio y Sonido'],
                ],
            ],
            [
                'name' => 'Moda y Ropa',
                'subcategories' => [
                    ['name' => 'Ropa Hombre'],
                    ['name' => 'Ropa Mujer'],
                    ['name' => 'Calzado'],
                    ['name' => 'Accesorios'],
                ],
            ],
            [
                'name' => 'Hogar y Cocina',
                'subcategories' => [
                    ['name' => 'Muebles'],
                    ['name' => 'Electrodomésticos Pequeños'],
                    ['name' => 'Decoración'],
                    ['name' => 'Utensilios de Cocina'],
                ],
            ],
            [
                'name' => 'Deportes y Fitness',
                'subcategories' => [
                    ['name' => 'Ropa Deportiva'],
                    ['name' => 'Equipamiento'],
                    ['name' => 'Suplementos'],
                ],
            ],
            [
                'name' => 'Libros y Papelería',
                'subcategories' => [
                    ['name' => 'Ficción'],
                    ['name' => 'No Ficción'],
                    ['name' => 'Material Escolar'],
                ],
            ],
        ];

        foreach ($categoriesData as $categoryData) {

            $parentCategory = Category::factory()->create([
                CategoryEnum::NAME => $categoryData['name'],
                CategoryEnum::SLUG => Str::slug($categoryData['name']),
                CategoryEnum::PARENT_ID => null,
            ]);


            if (isset($categoryData['subcategories'])) {
                foreach ($categoryData['subcategories'] as $subCategoryData) {
                    Category::factory()->create([
                        CategoryEnum::NAME => $subCategoryData['name'],
                        CategoryEnum::SLUG => Str::slug($subCategoryData['name']),
                        CategoryEnum::PARENT_ID => $parentCategory->id,
                    ]);
                }
            }
        }
    }
}
