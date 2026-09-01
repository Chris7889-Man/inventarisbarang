<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $details = DetailTransaksi::with(['transaksi.user', 'barang'])
            ->join('transaksis', 'transaksis.id', '=', 'detail_transaksis.transaksi_id')
            ->orderBy('transaksis.tanggal', 'asc')
            ->select('detail_transaksis.*')
            ->get();
        return view('transaksi.index', compact('details'));
    }

    public function show($id)
    {
        $detail = DetailTransaksi::with(['transaksi.user', 'barang'])->findOrFail($id);
        return view('transaksi.show', compact('detail'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    public function tambah()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:masuk,keluar',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'nullable|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $barang = Barang::findOrFail($request->barang_id);

                if ($request->tanggal) {
                    $tanggalTransaksi = \Illuminate\Support\Carbon::parse($request->tanggal)
                        ->setTimeFrom(\Illuminate\Support\Carbon::now());
                } else {
                    $tanggalTransaksi = \Illuminate\Support\Carbon::now();
                }

                $transaksi = Transaksi::create([
                    'user_id' => auth()->id(),
                    'kode_transaksi' => 'TRX-' . time(),
                    'tipe' => $request->tipe,
                    'tanggal' => $tanggalTransaksi,
                    'keterangan' => $request->keterangan,
                ]);

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $request->jumlah,
                    'harga_satuan' => $barang->harga,
                ]);

                if ($request->tipe == 'masuk') {
                    $barang->increment('stok', $request->jumlah);
                } else {
                    $barang->decrement('stok', $request->jumlah);
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    }

    public function riwayat(Request $request)
    {
        $bulan = $request->get('bulan', now()->format('Y-m'));
        
        // Ambil transaksi per barang yang terjadi di bulan tersebut
        $riwayat = DetailTransaksi::with('barang')
            ->whereHas('transaksi', function($query) use ($bulan) {
                $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$bulan]);
            })
            ->get()
            ->groupBy('barang_id')
            ->map(function ($items) {
                $barang = $items->first()->barang;
                $masuk = $items->where('transaksi.tipe', 'masuk')->sum('jumlah');
                $keluar = $items->where('transaksi.tipe', 'keluar')->sum('jumlah');
                
                // Sisa stok saat ini
                $sisa = $barang->stok; 

                return (object) [
                    'nama_barang' => $barang->nama_barang,
                    'kategori' => $barang->kategori,
                    'masuk' => $masuk,
                    'keluar' => $keluar,
                    'sisa' => $sisa
                ];
            });

        $sumMasuk = $riwayat->sum('masuk');
        $sumKeluar = $riwayat->sum('keluar');

        return view('transaksi.riwayat', compact('riwayat', 'bulan', 'sumMasuk', 'sumKeluar'));
    }
}
