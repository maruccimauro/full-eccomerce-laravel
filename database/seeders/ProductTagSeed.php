<?php

namespace Database\Seeders;

use App\Fields\TagFields;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTagSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $tags = Tag::all();
        if ($products->count() === 0) {
            throw new \Exception('Se necesitan products para ejecutar ' . static::class);
        }

        if ($tags->count() === 0) {
            throw new \Exception('Se necesitan tags para ejecutar ' . static::class);
        }


        $products->each(function ($product) use ($tags) {
            $maxAttachTags = min(5, $tags->count());
            $tagsToAttach = rand(1, $maxAttachTags);

            $randomTags = $tags->random($tagsToAttach);
            $tagsIds = $randomTags->pluck(TagFields::ID)->toArray();

            $product->tags()->sync($tagsIds);
        });
    }
}
