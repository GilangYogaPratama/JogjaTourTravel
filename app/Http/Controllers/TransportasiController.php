<?php

namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mailer\Transport;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportasi = Transportasi::all();
        return view('pengelola.Transportasi.index', [
            'transportasi' => $transportasi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengelola.transportasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'nama_kendaraan' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'sopir' => 'required|string',
            'nomor_kendaraan' => 'required|string',
            'harga_sewa' => 'required|integer',
            'kursi' => 'required|integer',
            'gambar_kendaraan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]) ->validate();

        if ($request->hasFile('gambar_kendaraan')) {
            $path = $request->file('gambar_kendaraan')->store('images', 'public');
            $validatedData['gambar_kendaraan'] = $path; // Simpan nama file di DB
        }

        $transportasi = new Transportasi($validatedData);
        $transportasi->save();

        return redirect(route('Transportasi'))->with('success', 'Transportasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transportasi $transportasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transportasi = Transportasi::findOrFail($id);
        return view('pengelola.transportasi.edit', [
            'transportasi' => $transportasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string',
            'sopir' => 'required|string',
            'nomor_kendaraan' => 'required|string',
            'harga_sewa' => 'required|integer',
            'kursi' => 'required|integer',
            'gambar_kendaraan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $transportasi = Transportasi::findOrFail($id);

        if ($request->hasFile('gambar_kendaraan')) {
            // Hapus gambar lama jika ada
            if ($transportasi->gambar_kendaraan && Storage::disk('public')->exists($transportasi->gambar_kendaraan)) {
                Storage::disk('public')->delete($transportasi->gambar_kendaraan);
            }
    
            // Simpan gambar baru
            $path = $request->file('gambar_kendaraan')->store('images', 'public');
            $validatedData['gambar_kendaraan'] = $path;
        } else {
            $validatedData['gambar_kendaraan'] = $transportasi->gambar_kendaraan;
        }

        $transportasi->update($validatedData);

        return redirect(route('Transportasi'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transportasi = Transportasi::findOrFail($id);

        // Hapus gambar dari penyimpanan
        if ($transportasi->gambar_kendaraan && Storage::disk('public')->exists($transportasi->gambar_kendaraan)) {
            Storage::disk('public')->delete($transportasi->gambar_kendaraan);
        }

        $transportasi->delete();

        return redirect(route('Transportasi'))->with('success', 'Destinasi berhasil dihapus!');
    }
}
