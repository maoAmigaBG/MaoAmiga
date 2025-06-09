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
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->boolean("admin")->default(false);
            $table->boolean("anonimo")->default(false);
            $table->boolean("ativo")->default(true);
            $table->boolean("owner")->default(false);
            $table->foreignId("user_id")->constrained();
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
        Schema::dropIfExists('membros');
    }
};
