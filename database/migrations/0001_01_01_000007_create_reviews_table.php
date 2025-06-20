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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manga_id')->constrained('manga')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  
            $table->text('comment');                                         
            $table->unsignedInteger('likes')->default(0);                     
            $table->unsignedInteger('dislikes')->default(0);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
