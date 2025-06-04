<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'Pesanan';

    protected $fillable = [
        'wisatawan',
        'tanggal_keberangkatan',
        'telefon',
        'kota_asal',
        'titik_jemput',
        'jumlah_orang',
        'id_destinasi',
        'id_transportasi',
        'id_layanantambahan',
        'id_paket',
        'id_rekomendasi',
        'status_ketersediaan',
        'total_biaya',
    ];

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'pesanan_destinasi', 'pesanan_id', 'destinasi_id');
    }

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'id_transportasi');
    }

    public function layananTambahan()
    {
        return $this->belongsToMany(LayananTambahan::class, 'layanan_tambahan_pesanan', 'pesanan_id', 'id_layanantambahan');
    }

    public function paket() 
    {
        return $this->belongsTo('App\Models\Paket', 'id_paket');
    }

    public function rekomendasi() 
    {
        return $this->belongsTo('App\Models\Rekomendasi', 'id_rekomendasi');
    }

}
