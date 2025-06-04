<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Destinasi;
use App\Models\Rekomendasi;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use App\Models\LayananTambahan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\RekomendasiDestinasi;

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

    public function konfirmasi(Request $request)
    {
        $id = session('id_rekomendasi');

        // Ambil data dari form
        $dataDiri = $request->only([
            'wisatawan', 'kota_asal', 'jumlah_orang',
            'tanggal_keberangkatan', 'titik_jemput', 'telefon', 'total_biaya'
        ]);

        // Transportasi yang dipilih
        $transportasi = Transportasi::find($request->transportasi_id);

        // Layanan tambahan
        $layananTambahan = [];
        if ($request->has('id_layanantambahan')) {
            $layananTambahan = LayananTambahan::whereIn('id', $request->id_layanantambahan)->get();
        }

        // Ambil daftar destinasi dari hasil rekomendasi sebelumnya
        // (pastikan id_rekomendasi disimpan atau dikirim juga)

        $rekomendasi = Rekomendasi::with('destinasi')->findOrFail($id);

        $daftarDestinasi = $rekomendasi->destinasi;
        $rekomendasiId = $request->input('rekomendasi_id');

        return view('rekomendasi.konfirmasi', compact(
            'dataDiri', 'transportasi', 'layananTambahan', 'daftarDestinasi'
        ));
    }

    public function store(Request $request)
    {
        $dataDiri = json_decode($request->input('data'), true);

        $pesanan = Pesanan::create([
            'wisatawan' => $dataDiri['wisatawan'],
            'tanggal_keberangkatan' => $dataDiri['tanggal_keberangkatan'],
            'telefon' => $dataDiri['telefon'],
            'kota_asal' => $dataDiri['kota_asal'],
            'titik_jemput' => $dataDiri['titik_jemput'],
            'jumlah_orang' => $dataDiri['jumlah_orang'],
            'id_transportasi' => $request->input('transportasi_id'),
            'id_rekomendasi' => $dataDiri['id_rekomendasi'] ?? null,
            'total_biaya' => $request->input('total_biaya'),
            'status_ketersediaan' => 'tidak tersedia',
        ]);

        // Simpan ke pivot pesanan_destinasi
        $idDestinasi = $request->input('destinasi_id', []);
        $pesanan->destinasi()->attach($idDestinasi);

        // Simpan ke pivot layanan_tambahan_pesanan
        $idLayananTambahan = $request->input('id_layanantambahan', []);
        $pesanan->layananTambahan()->attach($idLayananTambahan);

        // Load relasi sebelum dikirim ke view
        $pesanan->load(['destinasi', 'transportasi', 'layananTambahan']);

        $jumlahOrang = $pesanan->jumlah_orang;
        $daftarDestinasi = $pesanan->destinasi;
        $layananTambahan = $pesanan->layananTambahan;
        $transportasi = $pesanan->transportasi;

        $totalDestinasiSemuaOrang = $daftarDestinasi->sum('harga') * $jumlahOrang;

        $totalLayananTambahan = $layananTambahan->sum(function ($item) use ($jumlahOrang) {
            return str_contains(strtolower($item->nama_layanan), 'catering')
                ? $item->harga_layanan * $jumlahOrang
                : $item->harga_layanan;
        });

        $hargaTransportasi = $transportasi->harga_sewa ?? 0;

        $totalAkhir = $totalDestinasiSemuaOrang + $totalLayananTambahan + $hargaTransportasi;


        return view('rekomendasi.pembayaran', compact(
            'pesanan',
            'jumlahOrang',
            'daftarDestinasi',
            'layananTambahan',
            'transportasi',
            'hargaTransportasi',
            'totalDestinasiSemuaOrang',
            'totalLayananTambahan',
            'totalAkhir',
            'dataDiri'
        ));
        
    }

    public function download($id)
    {
        $pesanan = Pesanan::with(['transportasi', 'layananTambahan', 'destinasi'])->findOrFail($id);

        // Hitung ulang total
        $jumlahOrang = $pesanan->jumlah_orang;
        $totalDestinasiSemuaOrang = $pesanan->destinasi->sum('harga') * $jumlahOrang;
        $totalLayananTambahan = $pesanan->layananTambahan->sum(function ($lt) use ($jumlahOrang) {
            return str_contains(strtolower($lt->nama_layanan), 'catering')
                ? $lt->harga_layanan * $jumlahOrang
                : $lt->harga_layanan;
        });
        $hargaTransportasi = $pesanan->transportasi->harga_sewa ?? 0;
        $totalAkhir = $totalDestinasiSemuaOrang + $totalLayananTambahan + $hargaTransportasi;

        $pdf = Pdf::loadView('pdf.detail_pesanan', compact(
            'pesanan',
            'jumlahOrang',
            'totalDestinasiSemuaOrang',
            'totalLayananTambahan',
            'hargaTransportasi',
            'totalAkhir'
        ));

        return $pdf->download('Detail_Pesanan_' . $pesanan->id . '.pdf');
    }
}
