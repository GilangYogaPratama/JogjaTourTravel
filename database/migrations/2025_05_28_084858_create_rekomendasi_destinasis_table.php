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
            $table->unsignedBigInteger('rekomendasi_id');
            $table->unsignedBigInteger('destinasi_id');
            $table->timestamps();
        
            $table->foreign('rekomendasi_id')->references('id')->on('rekomendasi')->onDelete('cascade');
            $table->foreign('destinasi_id')->references('id')->on('destinasi')->onDelete('cascade');
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
