@extends('layouts.app')
@section('title', 'Detail Barang')
@section('content')
<div class="card card-profil mx-auto" style="max-width:900px">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Detail Barang</span>
        <a href="{{ route('barang.index') }}" class="btn-return">
            <span class="return-icon"><i class="bi bi-arrow-left"></i></span>
            Kembali
        </a>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-4 text-center">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}" class="img-fluid rounded-4 shadow-sm" alt="Foto {{ $barang->nama_barang }}">
                @else
                    <div class="bg-white rounded-4 p-5 text-muted shadow-sm">
                        <i class="bi bi-camera-video fs-2 d-block mb-2 text-primary"></i>Tidak ada foto
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="card card-input p-3 h-100">
                            <small class="text-muted d-block mb-1">Nama Barang</small>
                            <strong class="fs-6">{{ $barang->nama_barang }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-info p-3 h-100">
                            <small class="text-muted d-block mb-1">Kategori</small>
                            <strong class="fs-6">{{ $barang->kategori ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-ringkas p-3 h-100">
                            <small class="text-muted d-block mb-1">Tanggal Input</small>
                            <strong class="fs-6">{{ $barang->created_at?->format('d/m/y') ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-upload p-3 h-100">
                            <small class="text-muted d-block mb-1">Waktu Input</small>
                            <strong class="fs-6">{{ $barang->created_at?->format('H:i:s') ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-profil p-3">
                            <small class="text-muted d-block mb-1">Keterangan</small>
                            <strong class="fs-6">{{ $barang->deskripsi ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
