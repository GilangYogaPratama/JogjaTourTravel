<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;
    protected $table = 'Rekomendasi';

    protected $fillable = [
        'budget',
        'jumlah_orang',
        'id_transportasi',
    ];

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'rekomendasi_destinasi')->withTimestamps();
    }

    public function layananTambahan()
    {
        return $this->belongsToMany(LayananTambahan::class, 'rekomendasi_layanantambahan');
    }

    public function transportasi()
    {
        return $this->belongsTo(Transportasi::class, 'id_transportasi');
    }
}