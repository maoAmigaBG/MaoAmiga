<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Ong_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("ong_types")->insert([
            [
                "nome" => "Ambiental",
            ],
            [
                "nome" => "Assistência Social",
            ],
            [
                "nome" => "Direitos Humanos",
            ],
            [
                "nome" => "Educação",
            ],
            [
                "nome" => "Saúde",
            ],
            [
                "nome" => "Animais",
            ],
            [
                "nome" => "Cultura e Arte",
            ],
            [
                "nome" => "Desenvolvimento Comunitário",
            ],
            [
                "nome" => "Esporte e Lazer",
            ],
            [
                "nome" => "Infância e Juventude",
            ],
            [
                "nome" => "Defesa do Consumidor",
            ],
            [
                "nome" => "Defesa do Idoso",
            ],
            [
                "nome" => "Moradia",
            ],
            [
                "nome" => "Combate à Pobreza",
            ],
            [
                "nome" => "Direitos das Mulheres",
            ],
            [
                "nome" => "Inclusão Social",
            ],
            [
                "nome" => "Trabalho e Emprego",
            ],
            [
                "nome" => "Cidadania",
            ],
            [
                "nome" => "Meio Ambiente",
            ],
            [
                "nome" => "Pesquisa Científica",
            ],
            [
                "nome" => "Defesa Civil",
            ],
            [
                "nome" => "Combate às Drogas",
            ],
            [
                "nome" => "Tecnologia Social",
            ],
            [
                "nome" => "Refugiados e Imigrantes",
            ],
        ]);
/*
Ambiental
Assistência Social
Direitos Humanos
Educação
Saúde
Animais
Cultura e Arte
Desenvolvimento Comunitário
Esporte e Lazer
Infância e Juventude
Defesa do Consumidor
Defesa do Idoso
Moradia
Combate à Pobreza
Direitos das Mulheres
Inclusão Social
Trabalho e Emprego
Cidadania
Meio Ambiente
Pesquisa Científica
Defesa Civil
Combate às Drogas
Tecnologia Social
Refugiados e Imigrantes

*/
    }
}
