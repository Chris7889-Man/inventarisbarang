@extends('layouts.app')
@section('title', 'Detail Barang')
@section('content')
<style>
.detail-barang-page .card-profil,
.detail-barang-page .card-input,
.detail-barang-page .card-ringkas,
.detail-barang-page .card-info,
.detail-barang-page .card-upload {
    background: #fff !important;
    border-color: #e2e8f0 !important;
}
</style>
<div class="detail-barang-page mx-auto" style="max-width: 800px;">
<div class="card card-info">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Detail Barang</span>
        <a href="{{ route('barang.index') }}" class="btn-return">
            <span class="return-icon"><i class="bi bi-arrow-left"></i></span>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="row g-3">
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
                        <div class="card card-profil p-3 h-100">
                            <small class="text-muted d-block mb-1">Nama Barang</small>
                            <strong class="fs-6">{{ $barang->nama_barang }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-input p-3 h-100">
                            <small class="text-muted d-block mb-1">Kategori</small>
                            <strong class="fs-6">{{ $barang->kategori ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-ringkas p-3 h-100">
                            <small class="text-muted d-block mb-1">Tanggal Input</small>
                            <strong class="fs-6">{{ strtolower($barang->created_at?->translatedFormat('d/m/y | F') ?? '-') }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-upload p-3 h-100">
                            <small class="text-muted d-block mb-1">Waktu Input</small>
                            <strong class="fs-6">{{ $barang->created_at?->format('H:i:s') ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-info p-3">
                            <small class="text-muted d-block mb-1">Keterangan</small>
                            <strong class="fs-6">{{ $barang->deskripsi ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($barang->drive_folder_id)
<div class="card card-ringkas mt-4">
    <div class="card-header bg-white"><i class="bi bi-google text-danger me-2"></i>Google Drive</div>
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <a href="https://drive.google.com/drive/folders/{{ $barang->drive_folder_id }}" target="_blank" class="btn btn-outline-primary">
                <i class="bi bi-folder2-open me-1"></i> Buka Folder Foto Barang
            </a>
            <span class="text-muted small">Tersimpan di Drive (Share ke: {{ \App\Models\Setting::first()?->default_email ?? '-' }})</span>
        </div>
    </div>
</div>
@endif

<div class="card card-ringkas mt-4">
    <div class="card-header">Riwayat Transaksi Barang</div>
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-sm table-hover table-bordered-soft mb-0 text-center align-middle">
            <thead class="position-sticky top-0 bg-white z-10">
                <tr>
                    <th>NO</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($item->transaksi?->tipe == 'masuk')
                            <span class="badge bg-success-subtle text-success-emphasis">Masuk</span>
                        @elseif($item->transaksi?->tipe == 'keluar')
                            <span class="badge bg-warning-subtle text-warning-emphasis">Keluar</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->transaksi?->tanggal?->format('d/m/y') ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="/transaksi/{{ $item->id }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Tidak ada data riwayat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
</div>
@endsection
