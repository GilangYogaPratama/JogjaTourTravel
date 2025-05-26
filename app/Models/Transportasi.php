<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;
    protected $table = 'Transportasi';

    protected $fillable = [
        'nama_kendaraan',
        'jenis_kendaraan',
        'sopir',
        'nomor_kendaraan',
        'harga_sewa',
        'kursi',
        'gambar_kendaraan',
    ];
}
