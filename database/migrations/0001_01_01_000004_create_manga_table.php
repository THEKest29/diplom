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
        Schema::create('manga', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('author');
            $table->string('artist')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'hiatus', 'canceled']);
            $table->integer('year')->nullable();
            $table->text('description');
            $table->string('cover_path');
            $table->string('publisher')->nullable();
            $table->integer('volumes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manga');
    }
};
