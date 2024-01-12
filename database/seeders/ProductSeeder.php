<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // eliminar imagenes de productos
        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/products');

        Product::factory()->count(250)->create()->each(function (Product $product) {

            $faker = Faker::create();

            $product->image()->create(['url' => 'products/'.$faker->image('public/storage/products', 640, 480, 'Product', false)]);
        });
    }
}
