@extends('layouts.app')
@section('title', 'Daftar Barang')
@section('content')
<div class="card card-info">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Barang</span>
        <a class="btn btn-primary btn-sm" href="/barang/create"><i class="bi bi-plus-lg me-1"></i>Input Barang Baru</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered-soft mb-0 text-center align-middle">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th class="d-none d-md-table-cell">Kategori</th>
                    <th class="d-none d-sm-table-cell">Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-center">
                        <i class="bi bi-camera-video fs-5 text-muted cursor-pointer foto-popup-trigger"
                           data-src="{{ $barang->foto ? asset('storage/' . $barang->foto) : '#' }}"
                           title="Lihat foto"></i>
                    </td>
                    <td class="fw-semibold">{{ $barang->nama_barang }}</td>
                    <td class="d-none d-md-table-cell">{{ $barang->kategori ?? '-' }}</td>
                    <td class="d-none d-sm-table-cell">{{ $barang->created_at?->format('d/m/y') ?? '-' }}</td>
                    <td><a href="{{ route('barang.show', $barang) }}" class="btn btn-sm btn-outline-secondary" title="Lihat detail"><i class="bi bi-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-muted py-4">Belum ada data barang.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
