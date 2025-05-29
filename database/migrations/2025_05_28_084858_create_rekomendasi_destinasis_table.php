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
        Schema::create('rekomendasi_destinasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekomendasi_id')->constrained('rekomendasi')->onDelete('cascade');
            $table->foreignId('destinasi_id')->constrained('destinasi')->onDelete('cascade');
            $table->timestamps();
        });        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_destinasi');
    }
};
