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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Guest name
            $table->string('program'); // Guest name
            $table->string('image_url'); // URL of the guest's image
            $table->integer('views')->default(0); // Number of views
            $table->string('hashtag')->nullable(); // Optional hashtag
            $table->string('video_url');
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
