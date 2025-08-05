<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("contacts")->insert([
            [
                "nome" => "https://www.instagram.com/ivanpra/?utm_source=ig_web_button_share_sheet",
                "tipo" => "Instagram",
                "ong_id" => 1,
            ],
            [
                "nome" => "https://www.linkedin.com/in/ivan-pr%C3%A1-41584568",
                "tipo" => "LinkedIn",
                "ong_id" => 1,
            ],
        ]);
    }
}
