@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Detail Barang</span>
        <a href="/transaksi" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4 text-center">
                @if($detail->barang && $detail->barang->foto)
                    <img src="{{ asset('storage/' . $detail->barang->foto) }}" class="img-fluid rounded-4" alt="Foto Barang">
                @else
                    <div class="bg-light rounded-4 p-5 text-muted">Tidak ada foto</div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-sm-6"><div class="p-3 bg-light rounded-4"><small class="text-muted d-block">Nama Barang</small><strong>{{ $detail->barang->nama_barang ?? '-' }}</strong></div></div>
                    <div class="col-sm-6"><div class="p-3 bg-light rounded-4"><small class="text-muted d-block">Kategori</small><strong>{{ $detail->barang->kategori ?? '-' }}</strong></div></div>
                    <div class="col-sm-6"><div class="p-3 bg-light rounded-4"><small class="text-muted d-block">Jumlah</small><strong>{{ $detail->jumlah }}</strong></div></div>
                    <div class="col-sm-6"><div class="p-3 bg-light rounded-4"><small class="text-muted d-block">Tipe</small><strong>{{ $detail->transaksi->tipe ?? '-' }}</strong></div></div>
                    <div class="col-12"><div class="p-3 bg-light rounded-4"><small class="text-muted d-block">Tanggal</small><strong>{{ $detail->created_at ? $detail->created_at->format('d/m/y H:i:s') : '-' }}</strong></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
