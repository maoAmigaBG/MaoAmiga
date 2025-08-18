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
            $table->string("stripe_payment_intent_id")->unique()->nullable();
            $table->integer("doacao")->default(0);//store the amount in cents
            $table->string("moeda");
            $table->string("status")->default("pending");
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
