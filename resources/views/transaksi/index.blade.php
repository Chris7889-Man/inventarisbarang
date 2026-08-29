@extends('layouts.app')
@section('title', 'Daftar Transaksi')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Transaksi Barang</span>
        <a class="btn btn-primary btn-sm" href="/transaksi/create">Transaksi Baru</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered-soft mb-0 text-center">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($detail->barang && $detail->barang->foto)
                            <img src="{{ asset('storage/' . $detail->barang->foto) }}" alt="Foto" width="40" height="40" class="rounded">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $detail->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $detail->barang->kategori ?? '-' }}</td>
                    <td class="text-success fw-bold">{{ ($detail->transaksi && $detail->transaksi->tipe == 'masuk') ? $detail->jumlah : 0 }}</td>
                    <td class="text-danger fw-bold">{{ ($detail->transaksi && $detail->transaksi->tipe == 'keluar') ? $detail->jumlah : 0 }}</td>
                    <td>{{ $detail->created_at ? $detail->created_at->format('d/m/y') : '-' }}</td>
                    <td>{{ $detail->created_at ? $detail->created_at->format('H:i:s') : '-' }}</td>
                    <td>
                        <a href="/transaksi/{{ $detail->id }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
