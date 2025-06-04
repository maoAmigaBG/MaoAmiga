<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Post_likeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("post_likes")->insert([
            [
                "user_id" => 1,
                "post_id" => 1,
            ],
            [
                "user_id" => 1,
                "post_id" => 2,
            ],
        ]);
    }
}
