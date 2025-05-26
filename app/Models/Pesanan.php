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
        'id_destinasi',
        'id_transportasi',
        'id_layanantambahan',
        'id_paket',
        'id_rekomendasi',
        'status_ketersediaan',
        'status_jadwal_fix',
    ];

    public function Destinasi() 
    {
        return $this->belongsTo('App\Models\Destinasi', 'id_destinasi');
    }

    public function Transportasi() 
    {
        return $this->belongsTo('App\Models\Transportasi', 'id_transportasi');
    }

    public function LayananTambahan() 
    {
        return $this->belongsTo('App\Models\LayananTambahan', 'id_layanantambahan');
    }

    public function Paket() 
    {
        return $this->belongsTo('App\Models\Paket', 'id_paket');
    }

    public function Rekomendasi() 
    {
        return $this->belongsTo('App\Models\Rekomendasi', 'id_rekomendasi');
    }
}
