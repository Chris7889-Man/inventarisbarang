<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Barang::whereNotNull('kategori')->distinct()->pluck('kategori');
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'nullable|string',
            'kategori_baru' => 'nullable|string',
            'foto' => 'image|nullable',
            'tanggal' => 'nullable|date',
        ]);

        $data = $request->only(['nama_barang', 'satuan', 'deskripsi']);
        $data['kode_barang'] = 'BRG-' . time();
        $data['kategori'] = $request->kategori_baru ?: $request->kategori;
        $data['stok'] = 0;
        $data['harga'] = 0;
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }
        if ($request->tanggal) {
            $data['created_at'] = $request->tanggal . ' ' . now()->format('H:i:s');
            $data['updated_at'] = now();
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|numeric',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
