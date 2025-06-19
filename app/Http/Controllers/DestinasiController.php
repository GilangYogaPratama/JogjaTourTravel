<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use App\Models\KategoriDestinasi;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relasi kategori untuk efisiensi query
        $destinasi = Destinasi::with('kategori')->get();

        return view('pengelola.Destinasi.index', [
            'destinasi' => $destinasi
        ]);
    }

    public function showwisatawan()
    {
        // untuk wisatawan
        $destinasi = Destinasi::all();
        return view('rekomendasi.index', ['destinasi' => $destinasi]);
    }

    public function hasil()
    {
        // untuk wisatawan
        $destinasi = Destinasi::all();
        return view('rekomendasi.hasil', ['destinasi' => $destinasi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriList = KategoriDestinasi::all();
        return view('pengelola.destinasi.create', compact('kategoriList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_destinasi' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'rating' => 'required|numeric|between:0,5',
            'gambar_wisata' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategori_destinasi,id',
        ]);
        

        if ($request->hasFile('gambar_wisata')) {
            $path = $request->file('gambar_wisata')->store('images', 'public');
            $validatedData['gambar_wisata'] = $path;
        }

        Destinasi::create($validatedData);

        return redirect(route('Destinasi'))->with('success', 'Destinasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destinasi $destinasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $kategoriList = KategoriDestinasi::all();

        return view('pengelola.destinasi.edit', compact('destinasi', 'kategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_destinasi' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'rating' => 'required|numeric',
            'gambar_wisata' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategori_destinasi,id',
        ]);

        $destinasi = Destinasi::findOrFail($id);

        if ($request->hasFile('gambar_wisata')) {
            if ($destinasi->gambar_wisata && Storage::disk('public')->exists($destinasi->gambar_wisata)) {
                Storage::disk('public')->delete($destinasi->gambar_wisata);
            }

            $path = $request->file('gambar_wisata')->store('images', 'public');
            $validatedData['gambar_wisata'] = $path;
        } else {
            $validatedData['gambar_wisata'] = $destinasi->gambar_wisata;
        }

        $destinasi->update($validatedData);

        return redirect(route('Destinasi'))->with('success', 'Destinasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        // Hapus gambar dari penyimpanan
        if ($destinasi->gambar_wisata && Storage::disk('public')->exists($destinasi->gambar_wisata)) {
            Storage::disk('public')->delete($destinasi->gambar_wisata);
        }

        $destinasi->delete();

        return redirect(route('Destinasi'))->with('success', 'Destinasi berhasil dihapus!');
    }
}
