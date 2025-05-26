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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->boolean('status_pembayaran');
            $table->dateTime('tanggal_pembayaran');
            $table->dateTime('tanggal_konfirmasi');
            $table->string('bukti_pembayaran');
            $table->unsignedBigInteger('id_pesanan');

            $table->foreign('id_pesanan')->references('id')->on('pesanan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
