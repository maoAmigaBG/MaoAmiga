<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ong_type extends Model {
    protected $fillable = [
        "name"
    ];
}
/*
Ong_type::insert([
["name" => "Direitos Humanos"],
["name" => "Meio Ambiente"],
["name" => "Saúde"],
["name" => "Educação"],
["name" => "Bem-Estar Social"],
["name" => "Ajuda em Desastres"],
["name" => "Proteção Animal"],
["name" => "Cultura e Artes"],
["name" => "Desenvolvimento Econômico"],
["name" => "Direitos das Mulheres"],
["name" => "Direitos das Crianças"],
["name" => "Direitos LGBTQ+"],
["name" => "Direitos Indígenas"],
["name" => "Apoio aos Idosos"],
["name" => "Segurança Alimentar"],
["name" => "Água e Saneamento"],
["name" => "Apoio a Refugiados e Migrantes"],
["name" => "Tecnologia e Inovação"],
["name" => "Saúde Mental"],
["name" => "Apoio a Pessoas com Deficiência"]
])
*/