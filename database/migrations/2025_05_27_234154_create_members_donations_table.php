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
        Schema::create('members_donations', function (Blueprint $table) {
            $table->id();
            $table->decimal("doacao", 8, 2);
            $table->foreignId("member_id")->constrained();
            $table->foreignId("campaign_id")->constrained();
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
