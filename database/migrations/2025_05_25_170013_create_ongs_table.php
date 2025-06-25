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
            $table->decimal("lat", 10, 7)->nullable();
            $table->decimal("lng", 10, 7)->nullable();
            $table->string("endereco");
            $table->string("banner")->nullable();
            $table->string("foto")->nullable();
            $table->foreignId("ong_type_id")->constrained();
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
