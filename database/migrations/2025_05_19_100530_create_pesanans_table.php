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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('wisatawan');
            $table->date('tanggal_keberangkatan');
            $table->string('telefon');
            $table->text('kota_asal');
            $table->string('titik_jemput');

            $table->unsignedBigInteger('id_destinasi');
            $table->unsignedBigInteger('id_transportasi');
            $table->unsignedBigInteger('id_layanantambahan');
            $table->unsignedBigInteger('id_paket');
            $table->unsignedBigInteger('id_rekomendasi')->nullable();
            $table->enum('status_ketersediaan', ['tersedia', 'tidak tersedia']);
            $table->date('status_jadwal_fix');

            $table->foreign('id_destinasi')->references('id')->on('destinasi');
            $table->foreign('id_transportasi')->references('id')->on('transportasi');
            $table->foreign('id_layanantambahan')->references('id')->on('layanantambahan');
            $table->foreign('id_paket')->references('id')->on('paket');
            $table->foreign('id_rekomendasi')->references('id')->on('rekomendasi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
