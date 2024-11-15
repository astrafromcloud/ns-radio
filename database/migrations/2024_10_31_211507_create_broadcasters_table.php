<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('broadcasters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_path');
            $table->json('bio');
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcasters');
    }
};
