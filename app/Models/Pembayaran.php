<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'Rekomendasi';

    protected $fillable = [
        'status_pembayaran',
        'tanggal_pembayaran',
        'tanggal_konfirmasi',
        'buktibukti_pembayaran',
        'id_pesanan',
    ];

    public function Pesanan() 
    {
        return $this->belongsTo('App\Models\Pesanan', 'id_pesanan');
    }
}
