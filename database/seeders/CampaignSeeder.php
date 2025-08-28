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
        DB::table("campaigns")->insert([
            [
                "nome" => "Ajude winston a viajar",
                "tipo" => "doacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => json_encode([]),
                "meta" => 20000,
                "foto" => "campaigns/turtles_campaign.jpg",
                "ong_id" => 1,
            ],
            [
                "nome" => "Faça as malas de winston",
                "tipo" => "informacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => json_encode(['lorem ipsum', 'terno para tartarugas', 'pantufa para tartarugas', 'óculos de sol para tartarugas']),                
                "meta" => null,
                "foto" => "campaigns/turtles_campaign.jpg",
                "ong_id" => 1,
            ],
            [
                "nome" => "Ajude greg a comprar enchaguante bucal",
                "tipo" => "doacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => json_encode([]),
                "meta" => 15500,
                "foto" => "campaigns/tamandua_campaign.png",
                "ong_id" => 2,
            ],
            [
                "nome" => "Compre presentes de anversário para greg",
                "tipo" => "informacao",
                "descricao" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque labore laborum dolor ex id, inventore iusto ipsam, error veniam, odit expedita? Corporis quod quaerat sunt impedit eaque, laboriosam obcaecati reiciendis!",
                "materiais" => json_encode([]),
                "meta" => null,
                "foto" => "campaigns/tamandua_campaign.png",
                "ong_id" => 2,
            ],
        ]);
    }
}
