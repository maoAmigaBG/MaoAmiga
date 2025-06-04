<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            Ong_typeSeeder::class,
            OngSeeder::class,
            ContatoSeeder::class,
            CampaignSeeder::class,
            PostSeeder::class,
            Post_photoSeeder::class,
            Post_likeSeeder::class,
            MembroSeeder::class,
            Membro_doacaoSeeder::class,
        ]);
    }
}
