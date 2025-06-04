<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananTambahan extends Model
{
    use HasFactory;
    protected $table = 'LayananTambahan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi_layanan',
        'harga_layanan',
    ];

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'paket_layanan', 'layanantambahan_id', 'paket_id')->withTimestamps();
    }

    public function rekomendasi()
    {
        return $this->belongsToMany(Rekomendasi::class, 'rekomendasi_layanan_tambahan');
    }

    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'layanan_tambahan_pesanan', 'layanan_tambahan_id', 'pesanan_id');
    }


}
