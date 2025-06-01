<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiDestinasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_destinasi';

    protected $fillable = [
        'rekomendasi_id',
        'destinasi_id',
    ];

    // Relasi ke Rekomendasi
    public function rekomendasi()
    {
        return $this->belongsTo(Rekomendasi::class);
    }

    // Relasi ke Destinasi
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
