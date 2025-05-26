<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'Paket';

    protected $fillable = [
        'nama_paket',
        'jumlah_orang',
        'waktu',
        'id_transportasi',
    ];

    public function Transportasi() 
    {
        return $this->belongsTo('App\Models\Transportasi', 'id_transportasi');
    }

    public function destinasi() 
    {
        return $this->belongsToMany(Destinasi::class, 'paket_destinasi');
    }

    public function layananTambahan() 
    {
        return $this->belongsToMany(LayananTambahan::class, 'paket_layanan', 'paket_id', 'layanantambahan_id')->withTimestamps();
    }
}
