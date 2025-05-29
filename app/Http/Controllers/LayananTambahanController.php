<?php

namespace App\Http\Controllers;

use App\Models\LayananTambahan;
use Illuminate\Http\Request;

class LayananTambahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanantambahan = LayananTambahan::all();
        return view('pengelola.LayananTambahan.index', [
            'layanantambahan' => $layanantambahan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengelola.layanantambahan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'nama_layanan' => 'required|string',
            'deskripsi_layanan' => 'required|string',
            'harga_layanan' => 'required|integer',
        ]) ->validate();

        $layanantambahan = new LayananTambahan($validatedData);
        $layanantambahan->save();

        return redirect(route('LayananTambahan'))->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LayananTambahan $layananTambahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $layanantambahan = LayananTambahan::findOrFail($id);
        return view('pengelola.layanantambahan.edit', [
            'layanantambahan' => $layanantambahan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'required|string',
            'harga_layanan' => 'required|integer',
        ]);

        $layanantambahan = LayananTambahan::findOrFail($id);

        $layanantambahan->update($validatedData);

        return redirect(route('LayananTambahan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanantambahan = LayananTambahan::findOrFail($id);
        $layanantambahan->delete();
        return redirect(route('LayananTambahan'));
    }
}
