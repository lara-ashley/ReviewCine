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
        // Usuário normal de teste
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Usuário admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'ashly.mg01@gmail.com',
            'password' => bcrypt('11280609'), 
            'is_admin' => true,
        ]);
    }
}
