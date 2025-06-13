<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin_pedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("admin_pedidos")->insert([
            [
                "ong_id" => 1,
                "membro_id" => 1,
            ],
            [
                "ong_id" => 1,
                "membro_id" => 2,
            ],
        ]);
    }
}
