<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // COMENTA O BORRA ESTO:
    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    // DEJA SOLO ESTO (que es el seeder que tú creaste):
    $this->call([
        UserSeeder::class,
        EstudianteSeeder::class,
    ]);
}
}
