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
        'id_destinasi',
        'id_transportasi',
        'id_layanantambahan',
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
}
