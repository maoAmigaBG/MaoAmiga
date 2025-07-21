<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Admin_requestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("admin_requests")->insert([
            [
                "ong_id" => 1,
                "member_id" => 1,
            ],
            [
                "ong_id" => 1,
                "member_id" => 2,
            ],
        ]);
    }
}
