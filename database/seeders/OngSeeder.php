<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OngSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("ongs")->insert([
            [
                "nome" => "Tartarugas douradas",
                "subtitulo" => "tartarugas de ouro são bonitas",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "lat" => "-29.1652079",
                "lng" => "-51.559487",
                "endereco" => "R. Livramento, 48 - Bairro Juventude, Bento Gonçalves",
                "banner" => "posts/turtle_eye.jpg",
                "foto" => "ongs/turtle_profile.jpg",
                "ong_type_id" => 1,
            ],
            [
                "nome" => "Tamanduás prateados",
                "subtitulo" => "tamanduás de prata são elegantes",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "lat" => "-29.1688186",
                "lng" => "-51.5692994",
                "endereco" => "R. Avelino Luiz Zat, 95 - Fenavinho, Bento Gonçalves",
                "banner" => "ongs/tamandua_banner.jpg",
                "foto" => "ongs/tamandua_profile.jpg",
                "ong_type_id" => 2,
            ],
        ]);
    }
}
