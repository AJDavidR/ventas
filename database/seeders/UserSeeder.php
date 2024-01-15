<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // eliminar imagenes de usuario
        Storage::deleteDirectory('public/users');
        Storage::makeDirectory('public/users');

        // Crear 10 usuarios random
        \App\Models\User::factory(10)->create();
        // Crear un usuario personalizado
        \App\Models\User::factory()->create([
            'name' => 'David Arrieta',
            'email' => 'test@gmail.com',
            'admin' => true,
            'active' => true,
        ]);
    }
}
