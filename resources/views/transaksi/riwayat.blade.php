@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')
<div class="card card-ringkas">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Riwayat Transaksi Barang</span>
        <form method="GET" action="/riwayat" class="d-flex gap-2 align-items-center">
            <select name="bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="all" {{ $bulan == 'all' ? 'selected' : '' }}>Semua Waktu</option>
            </select>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered-soft mb-0 text-center align-middle">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Total Masuk</th>
                    <th>Total Keluar</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->nama_barang ?? '-' }}</td>
                    <td>{{ $detail->kategori ?? '-' }}</td>
                    <td class="fw-bold text-success">{{ $detail->total_masuk }}</td>
                    <td class="fw-bold text-danger">{{ $detail->total_keluar }}</td>
                    <td class="fw-bold">{{ $detail->total_masuk + $detail->total_keluar }}</td>
                    <td>
                        <a href="/barang/{{ $detail->barang_id }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-muted text-center py-3">Belum ada data transaksi.</td></tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="fw-bold table-light">
                    <td colspan="3" class="text-start py-2">SUM TOTAL:</td>
                    <td class="text-success py-2">{{ $sumMasuk }}</td>
                    <td class="text-danger py-2">{{ $sumKeluar }}</td>
                    <td class="fw-bold py-2">{{ $sumTotal }}</td>
                    <td class="py-2">-</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
