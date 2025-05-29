<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function rekomendasi(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:1',
            'jumlah_orang' => 'required|numeric|min:1',
        ]);

        $totalBudget = $request->budget;
        $jumlahOrang = $request->jumlah_orang;
        $budgetPerOrang = $totalBudget / $jumlahOrang;

        // Ambil semua destinasi dan hitung rasio rating/harga
        $destinasiSemua = Destinasi::all()->map(function ($destinasi) {
            $destinasi->rasio = $destinasi->harga > 0 ? $destinasi->rating / $destinasi->harga : 0;
            return $destinasi;
        });

        $destinasiTerurut = $destinasiSemua->sortByDesc('rasio')->values();

        $destinasiTerpilih = [];
        $sisaBudget = $budgetPerOrang;

        foreach ($destinasiTerurut as $destinasi) {
            if ($destinasi->harga <= $sisaBudget) {
                $destinasiTerpilih[] = $destinasi;
                $sisaBudget -= $destinasi->harga;
            }
        }

        // Simpan ke session agar bisa diakses di halaman edit
        session()->put('rekomendasi_terpilih', collect($destinasiTerpilih)->pluck('id')->toArray());
        session()->put('budget_per_orang', $budgetPerOrang);
        session()->put('sisa_budget', $sisaBudget);
        session()->put('jumlah_orang', $jumlahOrang);
        session()->put('total_budget', $totalBudget);

        return view('rekomendasi.hasil', compact(
            'destinasiTerpilih',
            'budgetPerOrang',
            'jumlahOrang',
            'totalBudget',
            'sisaBudget'
        ));
    }

    public function redirectToEdit(Request $request)
    {
        return redirect()->route('rekomendasi.edit');
    }

    public function edit()
    {
        $semuaDestinasi = Destinasi::all();

        $daftar = session()->get('daftar_destinasi', []);
        $destinasiTerpilih = session()->get('rekomendasi_terpilih', []);

        // Gabungkan ID dari dua array
        $gabunganIDs = array_unique(array_merge($daftar, $destinasiTerpilih));
        $gabunganDestinasi = Destinasi::whereIn('id', $gabunganIDs)->get();

        // Data yang dibutuhkan di view
        $daftarDestinasi = Destinasi::whereIn('id', $daftar)->get();
        $totalHargaPerOrang = $gabunganDestinasi->sum('harga');
        $budgetPerOrang = session()->get('budget_per_orang', 0);
        $sisaBudget = session()->get('sisa_budget', 0);

        return view('rekomendasi.edit', compact(
            'semuaDestinasi',
            'gabunganDestinasi',
            'daftarDestinasi',
            'destinasiTerpilih',
            'totalHargaPerOrang',
            'budgetPerOrang',
            'sisaBudget'
        ));
    }

    public function simpan()
    {
        $manual = session()->get('daftar_destinasi', []);
        $rekomendasi = session()->get('rekomendasi_terpilih', []);
        $semua = array_unique(array_merge($manual, $rekomendasi));
    
        $jumlahOrang = session()->get('jumlah_orang', 1);
        $totalHarga = Destinasi::whereIn('id', $semua)->sum('harga') * $jumlahOrang;
    
        return redirect()->route('checkout.show')->with([
            'daftar_destinasi' => $semua,
            'total_harga' => $totalHarga,
        ]);
    }    

    public function tambah(Request $request)
    {
        $id = $request->input('id');
        $daftar = session()->get('daftar_destinasi', []);
        if (!in_array($id, $daftar)) {
            $daftar[] = $id;
        }
        session(['daftar_destinasi' => $daftar]);
        return redirect()->back();
    }

    public function hapus(Request $request)
    {
        $id = $request->input('id');

        $daftar = session()->get('daftar_destinasi', []);
        $rekomendasi = session()->get('rekomendasi_terpilih', []);

        // Hapus dari keduanya
        $daftar = array_filter($daftar, fn($item) => $item != $id);
        $rekomendasi = array_filter($rekomendasi, fn($item) => $item != $id);

        // Reindex untuk menjaga konsistensi array
        session([
            'daftar_destinasi' => array_values($daftar),
            'rekomendasi_terpilih' => array_values($rekomendasi)
        ]);

        return redirect()->back();
    }

    public function tambahDestinasi(Request $request, $id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        $rekomendasi->destinasi()->syncWithoutDetaching([$request->destinasi_id]);

        return response()->json(['success' => true]);
    }

    public function hapusDestinasi(Request $request, $id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        $rekomendasi->destinasi()->detach($request->destinasi_id);

        return response()->json(['success' => true]);
    }

    public function batalkan()
    {
        // Hapus semua data terkait pemesanan dari session
        session()->forget([
            'rekomendasi_terpilih',
            'daftar_destinasi',
            'budget_per_orang',
            'sisa_budget',
            'jumlah_orang',
            'total_budget'
        ]);

        // Redirect ke halaman awal rekomendasi atau halaman lain sesuai alurmu
        return redirect('/')->with('status', 'Pemesanan berhasil dibatalkan.');
    }
}