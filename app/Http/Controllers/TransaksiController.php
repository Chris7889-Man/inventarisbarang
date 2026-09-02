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

        $riwayat = DetailTransaksi::with(['transaksi.user', 'barang'])
            ->where('barang_id', $detail->barang_id)
            ->join('transaksis', 'transaksis.id', '=', 'detail_transaksis.transaksi_id')
            ->orderBy('transaksis.tanggal', 'asc')
            ->orderByDesc('detail_transaksis.id')
            ->select('detail_transaksis.*')
            ->get();

        $semua = DetailTransaksi::with(['transaksi.user', 'barang'])
            ->join('transaksis', 'transaksis.id', '=', 'detail_transaksis.transaksi_id')
            ->orderBy('transaksis.tanggal', 'asc')
            ->select('detail_transaksis.*')
            ->get();

        $nomorMap = [];
        foreach ($semua as $i => $dt) {
            $nomorMap[$dt->id] = $i + 1;
        }

        return view('transaksi.show', compact('detail', 'riwayat', 'nomorMap'));
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
        $bulan = $request->get('bulan', 'all');
        $date = $bulan !== 'all' ? \Illuminate\Support\Carbon::parse($bulan) : null;

        $query = DB::table('detail_transaksis')
            ->join('transaksis', 'transaksis.id', '=', 'detail_transaksis.transaksi_id')
            ->join('barangs', 'barangs.id', '=', 'detail_transaksis.barang_id')
            ->select(
                'barangs.id as barang_id',
                'barangs.nama_barang',
                'barangs.kategori',
                DB::raw("SUM(CASE WHEN transaksis.tipe = 'masuk' THEN detail_transaksis.jumlah ELSE 0 END) as total_masuk"),
                DB::raw("SUM(CASE WHEN transaksis.tipe = 'keluar' THEN detail_transaksis.jumlah ELSE 0 END) as total_keluar")
            )
            ->groupBy('barangs.id', 'barangs.nama_barang', 'barangs.kategori');

        if ($date) {
            $query->whereMonth('transaksis.tanggal', $date->month)
                  ->whereYear('transaksis.tanggal', $date->year);
        }

        $details = $query->get();

        $sumMasuk = $details->sum('total_masuk');
        $sumKeluar = $details->sum('total_keluar');
        $sumTotal = $sumMasuk + $sumKeluar;

        return view('transaksi.riwayat', compact('details', 'bulan', 'sumMasuk', 'sumKeluar', 'sumTotal'));
    }
}
