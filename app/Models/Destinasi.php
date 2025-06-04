<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;
    protected $table = 'destinasi';

    protected $fillable = [
        'nama_destinasi',
        'lokasi',
        'deskripsi',
        'harga',
        'rating',
        'gambar_wisata',
    ];

    // app/Models/Destinasi.php
    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'paket_destinasi');
    }

    public function rekomendasi()
    {
        return $this->belongsToMany(Rekomendasi::class, 'rekomendasi_destinasi')->withTimestamps;
    }

    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_destinasi', 'destinasi_id', 'pesanan_id');
    }


}
