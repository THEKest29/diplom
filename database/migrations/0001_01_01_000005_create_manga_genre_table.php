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
        Schema::create('manga_genre', function (Blueprint $table) {
            $table->foreignId('manga_id')->constrained('manga')->cascadeOnDelete();
    $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
    $table->timestamps(); // Только если действительно нужны
    $table->unique(['manga_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manga_genre');
    }
};
