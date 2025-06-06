<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("membros")->insert([
            [
                "nivel" => true,
                "anonimo" => true,
                "user_id" => 1,
                "ong_id" => 1,
            ],
            [
                "nivel" => false,
                "anonimo" => true,
                "user_id" => 2,
                "ong_id" => 1,
            ],
            [
                "nivel" => true,
                "anonimo" => true,
                "user_id" => 2,
                "ong_id" => 2,
            ],
            [
                "nivel" => false,
                "anonimo" => true,
                "user_id" => 1,
                "ong_id" => 2,
            ],
        ]);
    }
}
