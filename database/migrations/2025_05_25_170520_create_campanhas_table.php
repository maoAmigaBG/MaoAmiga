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
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->enum("tipo", ["Doação", "Informação"]);
            $table->text("descricao");
            $table->text("materiais");
            $table->decimal("meta", 8, 2);
            $table->string("foto");
            $table->foreignId("ong_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
