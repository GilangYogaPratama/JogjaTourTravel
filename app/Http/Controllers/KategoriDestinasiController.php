<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriDestinasi;

class KategoriDestinasiController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategoridestinasi = KategoriDestinasi::all();
        return view('pengelola.destinasi.kategori.index', [
            'kategori_destinasi' => $kategoridestinasi
        ]);
    }

    // Form tambah kategori
    public function create()
    {
        return view('pengelola.destinasi.kategori.create');
    }

    // Simpan kategori ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriDestinasi::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Form edit kategori
    public function edit($id)
    {
        $kategori = KategoriDestinasi::findOrFail($id);
        return view('pengelola.destinasi.kategori.edit', compact('kategori'));
    }

    // Simpan perubahan kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriDestinasi::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = KategoriDestinasi::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
