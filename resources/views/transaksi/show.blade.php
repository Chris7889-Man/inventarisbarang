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
@if($detail->barang)
<div class="card card-ringkas mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span><i class="bi bi-camera text-primary me-2"></i>Aksi Foto & Google Drive</span>
    </div>
    <div class="card-body">
        <div class="row align-items-center g-3">
            <div class="col-md-6 border-end">
                <small class="text-muted d-block mb-2">Upload/Ganti Foto Barang:</small>
                <form id="fotoForm" action="{{ route('barang.foto', $detail->barang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="fotoFile" name="foto" class="d-none" accept="image/*" onchange="document.getElementById('fotoForm').submit()">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('fotoFile').click()">
                            <i class="bi bi-upload me-1"></i> Upload
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openCameraModal()">
                            <i class="bi bi-camera me-1"></i> Ambil Foto
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block mb-2">Akses Google Drive:</small>
                @if($detail->barang->drive_folder_id)
                    <a href="https://drive.google.com/drive/folders/{{ $detail->barang->drive_folder_id }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-folder2-open me-1"></i> Buka Drive
                    </a>
                    <span class="text-muted small d-block mt-1">Status: Terhubung</span>
                @else
                    <span class="badge bg-secondary-subtle text-secondary-emphasis mb-1">Belum Terhubung</span>
                    <small class="text-muted d-block">Upload foto di atas untuk membuat folder Drive otomatis.</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
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
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="/transaksi/{{ $item->id }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                            @if($item->id == $detail->id)
                            <form id="delete-form-{{ $item->id }}" action="/transaksi/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-id="{{ $item->id }}" data-nama="{{ $item->barang->nama_barang ?? 'Barang' }}" data-jumlah="{{ $item->jumlah }}" data-tipe="{{ $item->transaksi?->tipe ?? '-' }}"><i class="bi bi-trash"></i></button>
                            @endif
                        </div>
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

<div class="modal fade" id="modalHapus" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-exclamation-circle text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="fw-semibold mb-2">Anda yakin ingin menghapus transaksi ini?</p>
                <p class="text-muted mb-0"><span id="modal-nama"></span> — Jumlah: <strong id="modal-jumlah"></strong> (<span id="modal-tipe"></span>)</p>
                <p class="text-danger mt-2 mb-0"><small>Stok barang akan dikembalikan. Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0 pb-4">
                <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i>Batal</button>
                <button type="button" class="btn btn-danger px-3" id="btnConfirmHapus"><i class="bi bi-trash me-1"></i>Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.btn-hapus').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.id;
        document.getElementById('modal-nama').textContent = this.dataset.nama;
        document.getElementById('modal-jumlah').textContent = this.dataset.jumlah;
        document.getElementById('modal-tipe').textContent = this.dataset.tipe;
        document.getElementById('btnConfirmHapus').setAttribute('data-form-id', 'delete-form-' + id);
        new bootstrap.Modal(document.getElementById('modalHapus')).show();
    });
});
document.getElementById('btnConfirmHapus').addEventListener('click', function() {
    document.getElementById(this.dataset.formId).requestSubmit();
});
</script>

<div class="modal fade" id="cameraModalT" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <span class="fw-semibold">Ambil Foto Kamera</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <video id="camVideo" autoplay playsinline style="width:100%;max-height:300px;border-radius:10px;background:#000"></video>
                <canvas id="camCanvas" class="d-none"></canvas>
                <div id="camMsg" class="text-muted small mt-2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCamCapture" class="btn btn-success-soft rounded-pill">Ambil</button>
                <button type="button" class="btn btn-outline-secondary rounded-pill ms-auto" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
let camStream = null;

function openCameraModal() {
    if (!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)) {
        document.getElementById('camMsg').textContent = 'Kamera tidak didukung. Silakan gunakan Upload.';
        document.getElementById('fotoFile').click();
        return;
    }
    const modal = new bootstrap.Modal(document.getElementById('cameraModalT'));
    stopCamStream();
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function(stream) {
            camStream = stream;
            document.getElementById('camVideo').srcObject = stream;
            return document.getElementById('camVideo').play();
        })
        .then(function() {
            document.getElementById('camMsg').textContent = 'Arahkan kamera lalu tekan Ambil.';
            modal.show();
        })
        .catch(function() {
            document.getElementById('camMsg').textContent = 'Izin kamera ditolak. Membuka galeri...';
            document.getElementById('fotoFile').click();
        });
}

document.getElementById('btnCamCapture').addEventListener('click', function() {
    const video = document.getElementById('camVideo');
    const canvas = document.getElementById('camCanvas');
    canvas.width = video.videoWidth || 640;
    canvas.height = video.videoHeight || 480;
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    canvas.toBlob(function(blob) {
        if (!blob) return;
        const file = new File([blob], 'foto_kamera.png', { type: 'image/png' });
        const dt = new DataTransfer();
        dt.items.add(file);
        const input = document.getElementById('fotoFile');
        input.files = dt.files;
        stopCamStream();
        bootstrap.Modal.getInstance(document.getElementById('cameraModalT')).hide();
        document.getElementById('fotoForm').submit();
    }, 'image/png');
});

function stopCamStream() {
    if (camStream) {
        camStream.getTracks().forEach(function(t) { t.stop(); });
        camStream = null;
    }
}
document.getElementById('cameraModalT').addEventListener('hidden.bs.modal', stopCamStream);
</script>
@endsection
