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
        Schema::create('membros_doacoes', function (Blueprint $table) {
            $table->id();
            $table->decimal("doacao", 8, 2);
            $table->foreignId("user_id")->constrained();
            $table->foreignId("ong_id")->constrained();
            $table->foreignId("campanha_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros_doacoes');
    }
};
