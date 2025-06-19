<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDestinasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_destinasi'; // opsional jika sesuai konvensi

    protected $fillable = [
        'nama_kategori', // agar mass-assignment bisa dilakukan
    ];
}
