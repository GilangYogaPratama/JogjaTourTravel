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
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('budget');
            $table->integer('jumlah_orang');

            $table->unsignedBigInteger('id_destinasi');
            $table->unsignedBigInteger('id_transportasi');
            $table->unsignedBigInteger('id_layanantambahan');

            $table->foreign('id_destinasi')->references('id')->on('destinasi');
            $table->foreign('id_transportasi')->references('id')->on('transportasi');
            $table->foreign('id_layanantambahan')->references('id')->on('layanantambahan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi');
    }
};
