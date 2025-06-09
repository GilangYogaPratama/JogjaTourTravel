<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PembayaranController extends Controller
{
    public function verifikasi($id)
    {
        // Cari pesanan dan data pembayaran
        $pesanan = Pesanan::findOrFail($id);
        $pembayaran = Pembayaran::where('id_pesanan', $id)->first();

        return view('pengelola.pesanan.verifikasi', compact('pesanan', 'pembayaran'));
    }

    public function konfirmasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pembayaran = 1;
        $pembayaran->tanggal_konfirmasi = now();
        $pembayaran->save();

        return redirect()->route('pesanan.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_pembayaran', $filename, 'public');

            $pembayaran = Pembayaran::firstOrNew(['id_pesanan' => $id]);
            $pembayaran->id_pesanan = $id;
            $pembayaran->bukti_pembayaran = $filename;
            $pembayaran->save();

            $pesanan = Pesanan::with(['transportasi'])->findOrFail($id);
            $jumlahOrang = $pesanan->jumlah_orang;

            $daftarDestinasi = $pesanan->destinasi; // pastikan relasi `destinasi` ada di model Pesanan
            $layananTambahan = $pesanan->layananTambahan; // pastikan relasi `layananTambahan` juga ada

            $totalDestinasiSemuaOrang = $daftarDestinasi->sum('harga') * $jumlahOrang;
            $totalLayananTambahan = $layananTambahan->sum(function ($lt) use ($jumlahOrang) {
                return str_contains(strtolower($lt->nama_layanan), 'catering') 
                    ? $lt->harga_layanan * $jumlahOrang 
                    : $lt->harga_layanan;
            });
            $hargaTransportasi = $pesanan->transportasi->harga_sewa ?? 0;
            $totalAkhir = $totalDestinasiSemuaOrang + $totalLayananTambahan + $hargaTransportasi;

            return view('rekomendasi.berhasil', compact(
                'pesanan',
                'daftarDestinasi',
                'layananTambahan',
                'jumlahOrang',
                'totalDestinasiSemuaOrang',
                'totalLayananTambahan',
                'hargaTransportasi',
                'totalAkhir'
            ));
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    public function uploadManual(Request $request, $pesananId)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filename = time() . '.' . $request->bukti_pembayaran->extension();
        $request->bukti_pembayaran->storeAs('public/bukti_pembayaran', $filename);

        // Buat entri pembayaran baru jika belum ada
        $pembayaran = new Pembayaran();
        $pembayaran->id_pesanan = $pesananId;
        $pembayaran->bukti_pembayaran = $filename;
        $pembayaran->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }


}
