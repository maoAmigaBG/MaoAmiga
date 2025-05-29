<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ongs', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("subtitulo")->nullable();
            $table->text("descricao");
            $table->decimal("lat", 10, 7);
            $table->decimal("log", 10, 7);
            $table->string("endereco");
            $table->enum("tipo", ["Ambiental", "Assistência Social", "Direitos Humanos", "Educação", "Saúde", "Animais", "Cultura e Arte", "Desenvolvimento Comunitário", "Esporte e Lazer", "Infância e Juventude", "Defesa do Consumidor", "Defesa do Idoso", "Moradia", "Combate à Pobreza", "Direitos das Mulheres", "Inclusão Social", "Trabalho e Emprego", "Cidadania", "Meio Ambiente", "Pesquisa Científica", "Defesa Civil", "Combate às Drogas", "Tecnologia Social", "Refugiados e Imigrantes"]);
            $table->string("banner")->nullable();
            $table->string("foto")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongs');
    }
};
