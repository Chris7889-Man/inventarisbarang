@extends('layouts.app')
@section('title', 'Master Barang')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Master Barang</span>
        <a class="btn btn-primary btn-sm" href="/barang/create"><i class="bi bi-plus-lg me-1"></i>Input Barang Baru</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered-soft mb-0 text-center align-middle">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Foto</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" width="42" height="42" class="rounded-3" alt="Foto {{ $barang->nama_barang }}">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-start fw-semibold">{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori ?? '-' }}</td>
                    <td>{{ $barang->created_at?->format('d/m/y') ?? '-' }}</td>
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
