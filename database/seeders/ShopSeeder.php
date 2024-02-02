<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // eliminar imagenes de shop
        Storage::deleteDirectory('public/shop');
        Storage::makeDirectory('public/shop');

        Shop::factory(1)->create()->each(function(Shop $shop){
            
            $faker = Faker::create();

            $shop->image()->create(['url' => 'shops/'.$faker->image('public/storage/shop', 640, 480, 'shop', false)]);
            
        });
    }
}
