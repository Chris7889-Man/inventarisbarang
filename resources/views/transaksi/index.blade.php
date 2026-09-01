@extends('layouts.app')
@section('title', 'Daftar Transaksi')
@section('content')
<div class="card card-ringkas">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Transaksi Barang</span>
    </div>
    <div class="table-responsive" style="max-height: 430px; overflow-y: auto;">
        <table class="table table-hover table-bordered-soft mb-0 text-center align-middle" id="tabelTransaksi">
            <thead class="position-sticky top-0 bg-white z-10">
                <tr>
                    <th>NO</th>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th class="d-none d-md-table-cell">Kategori</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th class="d-none d-sm-table-cell">Tanggal</th>
                    <th class="d-none d-md-table-cell">Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-center">
                        <i class="bi bi-camera-video fs-5 text-muted cursor-pointer foto-popup-trigger"
                           data-src="{{ $detail->barang && $detail->barang->foto ? asset('storage/' . $detail->barang->foto) : '#' }}"
                           title="Lihat foto"></i>
                    </td>
                    <td>{{ $detail->barang->nama_barang ?? '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ $detail->barang->kategori ?? '-' }}</td>
                    <td class="fw-bold text-success">{{ ($detail->transaksi && $detail->transaksi->tipe == 'masuk') ? $detail->jumlah : 0 }}</td>
                    <td class="fw-bold text-danger">{{ ($detail->transaksi && $detail->transaksi->tipe == 'keluar') ? $detail->jumlah : 0 }}</td>
                    <td class="d-none d-sm-table-cell">{{ $detail->transaksi?->tanggal?->format('d/m/y') ?? '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ $detail->transaksi?->created_at?->format('H:i:s') ?? '-' }}</td>
                    <td>
                        <a href="/transaksi/{{ $detail->id }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
