<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Destinasi;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use App\Models\LayananTambahan;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::all();
        return view('pengelola.Paket.index', [
            'paket' => $paket
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinasi = Destinasi::all(); 
        $transportasi = Transportasi::all();
        $layanantambahan = LayananTambahan::all();
        return view('pengelola.paket.create', compact('destinasi', 'transportasi', 'layanantambahan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jumlah_orang' => 'required|integer|min:1',
            'waktu' => 'required|integer|min:1',
            'id_transportasi' => 'required|exists:transportasi,id',
            'id_destinasi' => 'required|array',
            'id_destinasi.*' => 'exists:destinasi,id',
            'id_layanantambahan' => 'nullable|array',
            'id_layanantambahan.*' => 'exists:layanantambahan,id',
        ]);

        $paket = Paket::create([
            'nama_paket' => $validated['nama_paket'],
            'jumlah_orang' => $validated['jumlah_orang'],
            'waktu' => $validated['waktu'],
            'id_transportasi' => $validated['id_transportasi'],
        ]);

        $paket->destinasi()->attach($validated['id_destinasi']);

        if (!empty($validated['id_layanantambahan'])) {
            $paket->layananTambahan()->attach($validated['id_layanantambahan']);
        }

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paket = Paket::with(['layanantambahan', 'destinasi'])->findOrFail($id);
        $transportasi = Transportasi::all();
        $layanantambahan = LayananTambahan::all();
        $destinasi = Destinasi::all();

        return view('pengelola.paket.edit', compact('paket', 'transportasi', 'layanantambahan', 'destinasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        // Validasi dan update data
        $paket->update([
            'nama_paket' => $request->nama_paket,
            'jumlah_orang' => $request->jumlah_orang,
            'waktu' => $request->waktu,
            'id_transportasi' => $request->id_transportasi,
        ]);

        // Sinkronisasi relasi
        $paket->layanantambahan()->sync($request->id_layanantambahan ?? []);
        $paket->destinasi()->sync($request->id_destinasi ?? []);

        return redirect()->route('pengelola.Paket')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        return redirect(route('Paket'));
    }
}