<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("posts")->insert([
            [
                "nome" => "Tartarugas mentionated !?!?",
                "descricao" => "Grupo de tartarugas foi avistado próximo à costa em uma área que antes era considerada sem atividade marinha. Biólogos estão monitorando o comportamento dos animais.",
                "foto" => "posts/turtle_post.jpg",
                "created_at" => "2025-06-21",
                "ong_id" => 1,
            ],
            [
                "nome" => "Tamanduá de roupa é resgatado",
                "descricao" => "Um tamanduá-bandeira foi encontrado usando roupas infantis no interior de Goiás. O animal foi resgatado por uma ONG e está sob observação veterinária.",
                "foto" => "posts/tamandua_post.jpg",
                "created_at" => "2025-06-22",
                "ong_id" => 2,
            ],
            [
                "nome" => "Capivara no volante chama atenção",
                "descricao" => "Uma capivara entrou em um carro destrancado em Brasília. Apesar do susto, o animal não se feriu e foi devolvido à natureza.",
                "foto" => "posts/capivara_post.jpg",
                "created_at" => "2025-06-23",
                "ong_id" => 1,
            ],
            [
                "nome" => "Lobo-guará reaparece no Cerrado",
                "descricao" => "Após anos sem registros, um lobo-guará foi fotografado por armadilhas fotográficas em uma área de conservação ambiental em Minas Gerais.",
                "foto" => "posts/onca_post.jpg",
                "created_at" => "2025-06-24",
                "ong_id" => 2,
            ],
            [
                "nome" => "Onça-pintada avistada com filhotes",
                "descricao" => "Equipe de conservação avistou uma onça-pintada com dois filhotes na região do Pantanal. A ONG monitora a família com drones e câmeras.",
                "foto" => "posts/onca_post.jpg",
                "created_at" => "2025-06-25",
                "ong_id" => 1,
            ],
            [
                "nome" => "Bicho-preguiça encontrado em árvore urbana",
                "descricao" => "Moradores de um bairro residencial encontraram um bicho-preguiça em uma árvore frutífera. O animal foi removido com segurança pela equipe de resgate.",
                "foto" => "posts/tamandua_post.jpg",
                "created_at" => "2025-06-26",
                "ong_id" => 2,
            ],
            [
                "nome" => "Pinguins aparecem em praia nordestina",
                "descricao" => "Três pinguins-de-magalhães foram resgatados após aparecerem em praia do Rio Grande do Norte, fora da rota migratória usual.",
                "foto" => "posts/turtles_post.jpg",
                "created_at" => "2025-06-27",
                "ong_id" => 1,
            ],
            [
                "nome" => "Baleia-jubarte encalhada é devolvida ao mar",
                "descricao" => "Uma baleia de 12 metros encalhada foi salva após horas de trabalho de voluntários e especialistas na costa da Bahia.",
                "foto" => "posts/tamandua_post.jpg",
                "created_at" => "2025-06-28",
                "ong_id" => 2,
            ],
            [
                "nome" => "Coruja ferida recebe tratamento",
                "descricao" => "Uma coruja-das-torres foi resgatada com uma asa ferida. Ela está recebendo cuidados e deve ser reabilitada em até duas semanas.",
                "foto" => "posts/capivara_post.jpg",
                "created_at" => "2025-06-29",
                "ong_id" => 1,
            ],
            [
                "nome" => "Monitoramento de ninho de araras",
                "descricao" => "Voluntários identificaram três ninhos de araras-azuis em uma região protegida. Câmeras foram instaladas para observação remota dos filhotes.",
                "foto" => "posts/onca_post.jpg",
                "created_at" => "2025-06-30",
                "ong_id" => 2,
            ],
            [
                "nome" => "Jacaré no quintal surpreende família",
                "descricao" => "Um jacaré de médio porte foi encontrado no quintal de uma casa após fortes chuvas. O animal foi resgatado sem ferimentos.",
                "foto" => "posts/turtles_post.jpg",
                "created_at" => "2025-07-01",
                "ong_id" => 1,
            ],
            [
                "nome" => "Cervo é resgatado de rodovia movimentada",
                "descricao" => "Um jovem cervo foi encontrado assustado na rodovia BR-101. A intervenção rápida da ONG evitou um possível acidente.",
                "foto" => "posts/capivara_post.jpg",
                "created_at" => "2025-07-02",
                "ong_id" => 2,
            ],
        ]);
    }
}
