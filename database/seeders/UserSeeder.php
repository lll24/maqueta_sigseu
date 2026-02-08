<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
public function run(): void
{
    // El "Súper Usuario" de Villa Asia
    User::create([
        'name' => 'Admin Central UNEG',
        'email' => 'admin.global@uneg.edu.ve',
        'role' => 'admin_global',
        'sede' => 'Villa Asia',
        'modulo' => null, // Ve todo
        'password' => Hash::make('admin123'),
    ]);

    // Administrador operativo de Becas
    User::create([
        'name' => 'Admin Becas',
        'email' => 'becas.va@uneg.edu.ve',
        'role' => 'admin_modulo',
        'sede' => 'Villa Asia',
        'modulo' => 'Becas',
        'password' => Hash::make('becas123'),
    ]);
}
}