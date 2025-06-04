<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("posts")->insert([
            [
                "nome" => "Tartarugas mentionated !?!?",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "ong_id" => 1,
            ],
            [
                "nome" => "Tamandua de roupa",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "ong_id" => 2,
            ],
        ]);
    }
}
