@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
@php
    $tipe = $detail->transaksi->tipe ?? '';
    $statusClass = ($tipe == 'masuk') ? 'card-masuk-soft' : (($tipe == 'keluar') ? 'card-keluar-soft' : '');
    $activeRowClass = ($tipe == 'masuk') ? 'row-aktif-masuk' : 'row-aktif-keluar';
@endphp
<style>
.detail-transaksi-page .card-profil,
.detail-transaksi-page .card-input,
.detail-transaksi-page .card-ringkas,
.detail-transaksi-page .card-info {
    background: #fff !important;
    border-color: #e2e8f0 !important;
}
.detail-transaksi-page tr.row-aktif-masuk td { background-color: #f0fdf4 !important; }
.detail-transaksi-page tr.row-aktif-keluar td { background-color: #fffbeb !important; }
.detail-transaksi-page .card-riwayat { background: #FAF6F0 !important; border: 1px solid #f0eadd !important; }
</style>
<div class="detail-transaksi-page mx-auto" style="max-width: 800px;">
<div class="card card-info">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Detail Barang</span>
        <a href="/transaksi" class="btn-return">
            <span class="return-icon"><i class="bi bi-arrow-left"></i></span>
            Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4 text-center">
                @if($detail->barang && $detail->barang->foto)
                    <img src="{{ asset('storage/' . $detail->barang->foto) }}" class="img-fluid rounded-4 shadow-sm" alt="Foto Barang">
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
                            <strong class="fs-6">{{ $detail->barang->nama_barang ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-input p-3 h-100">
                            <small class="text-muted d-block mb-1">Kategori</small>
                            <strong class="fs-6">{{ $detail->barang->kategori ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-ringkas p-3 h-100">
                            <small class="text-muted d-block mb-1">Jumlah</small>
                            <strong class="fs-6">{{ $detail->jumlah }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-upload {{ $statusClass }} p-3 h-100">
                            <small class="text-muted d-block mb-1">Tipe</small>
                            <strong class="fs-6">{{ $detail->transaksi->tipe ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-info p-3 h-100">
                            <small class="text-muted d-block mb-1">Tanggal Input</small>
                            @php
                                $tgl = $detail->transaksi?->tanggal;
                            @endphp
                            <strong class="fs-6">{{ $tgl?->format('d/m/y') }} | {{ strtolower(($tgl)?->translatedFormat('F') ?? '-') }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-info p-3 h-100">
                            <small class="text-muted d-block mb-1">Waktu Input</small>
                            <strong class="fs-6">{{ $detail->transaksi?->created_at?->format('H:i:s') ?? '-' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-ringkas card-riwayat mt-4">
    <div class="card-header">Riwayat Transaksi Barang</div>
    <div class="table-responsive" style="max-height: 240px; overflow-y: auto;">
        <table class="table table-sm table-hover table-bordered-soft mb-0 text-center align-middle">
            <thead class="position-sticky top-0 bg-white z-10">
                <tr>
                    <th>NO</th>
                    <th>Nama Barang</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $index => $item)
                <tr class="{{ $detail->id == $item->id ? $activeRowClass : '' }}">
                    <td>{{ $nomorMap[$item->id] ?? $index + 1 }}</td>
                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
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
                        <a href="/transaksi/{{ $item->id }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">Tidak ada data riwayat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
