<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Setting;
use App\Services\GoogleDriveService;
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
            
            $setting = Setting::first();
            if ($setting && $setting->drive_root_folder_id && $setting->default_email) {
                try {
                    $drive = new GoogleDriveService();
                    $folder = $drive->createFolder($data['nama_barang'], $setting->drive_root_folder_id);
                    $drive->shareFolder($folder->id, trim($setting->default_email));
                    $drive->uploadFile($folder->id, storage_path('app/public/' . $data['foto']), $data['nama_barang']);
                    $data['drive_folder_id'] = $folder->id;
                } catch (\Exception $e) {
                    \Log::error('Drive Upload Failed: ' . $e->getMessage());
                }
            }
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
        $riwayat = \App\Models\DetailTransaksi::with(['transaksi.user', 'barang'])
            ->where('barang_id', $barang->id)
            ->join('transaksis', 'transaksis.id', '=', 'detail_transaksis.transaksi_id')
            ->orderBy('transaksis.tanggal', 'desc')
            ->select('detail_transaksis.*')
            ->get();

        return view('barang.show', compact('barang', 'riwayat'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function updateFoto(Request $request, Barang $barang)
    {
        $request->validate(['foto' => 'required|image']);

        $path = $request->file('foto')->store('barang', 'public');
        $oldFoto = $barang->foto;
        $barang->update(['foto' => $path]);

        // Upload ke Drive
        $setting = Setting::first();
        if ($setting && $setting->drive_root_folder_id) {
            try {
                $drive = new GoogleDriveService();
                if (!$barang->drive_folder_id) {
                    $folder = $drive->createFolder($barang->nama_barang, $setting->drive_root_folder_id);
                    $barang->update(['drive_folder_id' => $folder->id]);
                    if ($setting->default_email) {
                        $drive->shareFolder($folder->id, trim($setting->default_email));
                    }
                }
                $drive->uploadFile($barang->drive_folder_id, storage_path('app/public/' . $path), $barang->nama_barang . '_' . time());
            } catch (\Exception $e) {
                \Log::error('Drive Update Failed: ' . $e->getMessage());
            }
        }

        if ($oldFoto && \Storage::disk('public')->exists($oldFoto)) {
            \Storage::disk('public')->delete($oldFoto);
        }

        return back()->with('success', 'Foto berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
