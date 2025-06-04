<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Membro_doacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("membros_doacoes")->insert([
            [
                "doacao" => 1000.5,
                "membro_id" => 1,
                "campanha_id" => 1,
            ],
            [
                "doacao" => 550,
                "membro_id" => 2,
                "campanha_id" => 1,
            ],
            [
                "doacao" => 1550.5,
                "membro_id" => 3,
                "campanha_id" => 2,
            ],
            [
                "doacao" => 250.75,
                "membro_id" => 4,
                "campanha_id" => 2,
            ],
        ]);
    }
}
