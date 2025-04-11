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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['information', 'donation'])->default("information");
            $table->string("name");
            $table->longText("description")->nullable();
            $table->integer("like_num")->default(0);
            $table->decimal("donate_size", total: 10, places:2);
            $table->decimal("donate_amount", total: 10, places:2);
            $table->integer("donate_num")->default(0);
            $table->string("photo")->nullable();
            $table->foreignId("ong_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
