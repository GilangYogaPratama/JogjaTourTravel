<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Rekomendasi;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use App\Models\LayananTambahan;
use Illuminate\Support\Facades\DB;

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

        // Hitung rasio (value/cost) untuk semua destinasi
        $allDestinasi = Destinasi::with('kategori')->get()->map(function ($destinasi) {
            $destinasi->rasio = $destinasi->harga > 0 ? $destinasi->rating / $destinasi->harga : 0;
            return $destinasi;
        });

        // Validasi awal budget
        $hargaTermurah = $allDestinasi->min('harga');
        if ($budgetPerOrang <= 0 || $budgetPerOrang < $hargaTermurah) {
            return redirect()->back()->with('error', 'Budget tidak cukup untuk destinasi manapun.');
        }

        $kategoriTersedia = $allDestinasi->pluck('kategori.nama_kategori')->unique()->toArray();
        $kategoriYangSudahDipakai = [];
        $sudahDipakaiId = [];
        $destinasiTerpilih = [];
        $sisaBudget = $budgetPerOrang;

        while (true) {
            $rasioTertinggi = null;
            $selected = null;

            // Pilih destinasi dengan rasio tertinggi dari kategori yang belum dipakai
            foreach ($allDestinasi as $destinasi) {
                $kategoriDestinasi = $destinasi->kategori->nama_kategori ?? 'Tidak Ada';

                if (
                    $destinasi->harga <= $sisaBudget &&
                    !in_array($destinasi->id, $sudahDipakaiId) &&
                    !in_array($kategoriDestinasi, $kategoriYangSudahDipakai)
                ) {
                    if (!$rasioTertinggi || $destinasi->rasio > $rasioTertinggi->rasio) {
                        $rasioTertinggi = $destinasi;
                    }
                }
            }

            if ($rasioTertinggi) {
                $destinasiTerpilih[] = $rasioTertinggi;
                $kategoriYangSudahDipakai[] = $rasioTertinggi->kategori->nama_kategori ?? 'Tidak Ada';
                $sudahDipakaiId[] = $rasioTertinggi->id;
                $sisaBudget -= $rasioTertinggi->harga;
            } else {
                // Fallback jika tidak ditemukan dari kategori baru
                foreach ($allDestinasi as $destinasi) {
                    if (
                        $destinasi->harga <= $sisaBudget &&
                        !in_array($destinasi->id, $sudahDipakaiId)
                    ) {
                        if (!$selected || $destinasi->rasio > $selected->rasio) {
                            $selected = $destinasi;
                        }
                    }
                }

                if ($selected) {
                    $destinasiTerpilih[] = $selected;
                    $sudahDipakaiId[] = $selected->id;
                    $sisaBudget -= $selected->harga;
                } else {
                    break;
                }
            }

            // Hentikan jika tidak ada destinasi terjangkau yang tersisa
            $masihAda = $allDestinasi->first(function ($d) use ($sisaBudget, $sudahDipakaiId) {
                return $d->harga <= $sisaBudget && !in_array($d->id, $sudahDipakaiId);
            });

            if (!$masihAda) {
                break;
            }

            // Reset kategori jika semua sudah dipakai
            if (count($kategoriYangSudahDipakai) >= count($kategoriTersedia)) {
                $kategoriYangSudahDipakai = [];
            }
        }

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
        $totalBudget = session()->get('total_budget', 0);
        $jumlahOrang = session()->get('jumlah_orang', 1);

        return view('rekomendasi.edit', compact(
            'semuaDestinasi',
            'gabunganDestinasi',
            'daftarDestinasi',
            'destinasiTerpilih',
            'totalHargaPerOrang',
            'budgetPerOrang',
            'sisaBudget',
            'totalBudget',
            'jumlahOrang' 
        ));
    }

    public function simpan()
    {
        $manual = session()->get('daftar_destinasi', []);
        $rekomendasi = session()->get('rekomendasi_terpilih', []);
        $semua = array_unique(array_merge($manual, $rekomendasi));

        $jumlahOrang = session()->get('jumlah_orang', 1);
        $budget = session()->get('total_budget', 0);

        // Simpan ke tabel rekomendasi
        $rekom = new Rekomendasi();
        $rekom->jumlah_orang = $jumlahOrang;
        $rekom->budget = $budget;
        $rekom->save();

        // Simpan ke tabel pivot rekomendasi_destinasi
        $rekom->destinasi()->sync($semua);

        session()->put('id_rekomendasi', $rekom->id);

        $totalHarga = Destinasi::whereIn('id', $semua)->sum('harga') * $jumlahOrang;

        return redirect()->route('rekomendasi.pesanan')->with([
            'daftar_destinasi' => $semua,
            'total_harga' => $totalHarga,
        ]);
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
        $totalBudget = $rekomendasi->budget;
        $totalHarga = $daftarDestinasi->sum('harga') * $jumlahOrang;

        // Ambil data layanan tambahan
        $layananTambahanList = LayananTambahan::all();

        // Ambil data transportasi
        $transportasiList = Transportasi::all();

        return view('rekomendasi.pesanan', compact(
            'daftarDestinasi',
            'jumlahOrang',
            'totalBudget',
            'totalHarga',
            'layananTambahanList',
            'transportasiList'
        ));
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
