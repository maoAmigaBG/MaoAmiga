<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->enum("tipo", ["doacao", "informacao"]);
            $table->text("descricao");
            $table->text("materiais");
            $table->decimal("meta", 8, 2)->nullable();
            $table->string("foto");
            $table->foreignId("ong_id")->constrained();
            $table->timestamps();
            $table->softDeletes();
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
