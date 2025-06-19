<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDestinasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_destinasi'; // optional, karena defaultnya sudah sesuai

    protected $fillable = [
        'nama_kategori',
    ];

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class, 'kategori_id');
    }

}
