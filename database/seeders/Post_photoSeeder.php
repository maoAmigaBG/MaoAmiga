<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Post_photoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("post_photos")->insert([
            [
                "nome" => "posts/turtles_post.jpg",
                "post_id" => 1,
            ],
            [
                "nome" => "posts/turtles_campaign.jpg",
                "post_id" => 1,
            ],
            [
                "nome" => "posts/tamandua_post.jpg",
                "post_id" => 2,
            ],
            [
                "nome" => "posts/tamandua_campaign.jpg",
                "post_id" => 2,
            ],
        ]);
    }
}
