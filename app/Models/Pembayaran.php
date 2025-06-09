<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'Pembayaran';

    protected $fillable = [
        'status_pembayaran',
        'tanggal_pembayaran',
        'tanggal_konfirmasi',
        'bukti_pembayaran',
        'id_pesanan',
    ];

    // Model Pembayaran
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function getIsLunasAttribute()
    {
        return !empty($this->bukti_pembayaran);
    }

}
