<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("campanhas")->insert([
            [
                "nome" => "Ajude winston a viajar",
                "tipo" => "doacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => "",
                "meta" => 20000,
                "foto" => "campaigns/turtles_campaign.jpg",
                "ong_id" => 1,
            ],
            [
                "nome" => "Faça as malas de winston",
                "tipo" => "informacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => "<ul><li>lorem ipsum</li><li>terno para tartarugas</li><li>pantufa para tartarugas</li><li>óculos de sol para tartarugas</li><li>fone de ouvido intraauricular para tartarugas</li></ul>",
                "meta" => null,
                "foto" => "campaigns/turtles_campaign.jpg",
                "ong_id" => 1,
            ],
            [
                "nome" => "Ajude greg a comprar enchaguante bucal",
                "tipo" => "doacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => "",
                "meta" => 15500,
                "foto" => "campaigns/tamandua_campaign.png",
                "ong_id" => 2,
            ],
            [
                "nome" => "Compre presentes de anversário para greg",
                "tipo" => "informacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => "<ul><li>lorem ipsum</li><li>terno para tartarugas</li><li>pantufa para tartarugas</li><li>óculos de sol para tartarugas</li><li>fone de ouvido intraauricular para tartarugas</li></ul>",
                "meta" => null,
                "foto" => "campaigns/tamandua_campaign.png",
                "ong_id" => 2,
            ],
        ]);
    }
}
