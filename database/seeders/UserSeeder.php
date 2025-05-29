<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("users")->insert([
            [
                "name" => "ADMIN",
                "email" => "admin@gmail.com",
                "password" => Hash::make("admin"),
                "descricao" => "admin",
                "data_nasc" => "2025-05-25",
                "foto" => "",
            ],
        ]);
    }
}
