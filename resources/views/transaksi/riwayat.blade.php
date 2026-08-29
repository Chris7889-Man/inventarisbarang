@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Riwayat Transaksi Barang</span>
        <form method="GET" action="/riwayat" class="d-flex gap-2">
            <input type="month" name="bulan" value="{{ $bulan }}" class="form-control form-control-sm" onchange="this.form.submit()">
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered-soft mb-0 text-center">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Sisa Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori ?? '-' }}</td>
                    <td class="text-success fw-bold">{{ $item->masuk }}</td>
                    <td class="text-danger fw-bold">{{ $item->keluar }}</td>
                    <td>{{ $item->sisa }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="fw-bold table-light">
                    <td colspan="3" class="text-end">SUM TOTAL:</td>
                    <td class="text-success">{{ $sumMasuk }}</td>
                    <td class="text-danger">{{ $sumKeluar }}</td>
                    <td>-</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
