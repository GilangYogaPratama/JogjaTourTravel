<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use App\Models\LayananTambahan;
use App\Models\Pesanan;

class PesananController extends Controller
{
    
    public function index()
    {
        $pesanan = Pesanan::all();
        return view('rekomendasi.pesanan.index', [
            'pesanan' => $pesanan
        ]);
    }

    public function create()
    {

        $layanantambahan = LayananTambahan::all();
        return view('rekomendasi.pesanan.create', compact('layanantambahan'));
    }

    public function pesanan()
    {
        $id = session('id_rekomendasi');

        if (!$id) {
            return redirect()->route('rekomendasi.edit')->with('error', 'Data pesanan tidak ditemukan.');
        }

        $rekomendasi = Rekomendasi::with('destinasi')->findOrFail($id);

        $daftarDestinasi = $rekomendasi->destinasi;
        $jumlahOrang = $rekomendasi->jumlah_orang;
        $totalBudget = $rekomendasi->total_budget;
        $totalHarga = $daftarDestinasi->sum('harga') * $jumlahOrang;


        return view('rekomendasi.pesanan', compact(
            'daftarDestinasi',
            'jumlahOrang',
            'totalBudget',
            'totalHarga',
            'layananTambahanList'
        ));
    }

}
