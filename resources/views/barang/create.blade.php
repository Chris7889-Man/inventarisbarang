@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="mx-auto" style="max-width:720px;">
    <h3>Input Barang Baru</h3>
    <form method="POST" action="/barang" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3 card-profil">
            <div class="card-header py-2">Nama Barang</div>
            <div class="card-body py-2">
                <input name="nama_barang" class="form-control" required>
            </div>
        </div>
        <div class="card mb-3 card-input">
            <div class="card-header py-2">Kategori</div>
            <div class="card-body py-2">
                <div class="mb-3">
                    <select name="kategori" class="form-select">
                        <option value="">Pilih kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori }}">{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label small text-muted">Kategori Baru</label>
                    <input name="kategori_baru" class="form-control" placeholder="Isi jika kategori belum ada">
                </div>
            </div>
        </div>
        <div class="card mb-3 card-ringkas">
            <div class="card-header py-2">Tanggal Barang Lama</div>
            <div class="card-body py-2">
                <input name="tanggal" type="date" class="form-control">
            </div>
        </div>
        <div class="card mb-3 card-info">
            <div class="card-header py-2">Keterangan</div>
            <div class="card-body py-2">
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
        </div>
        <div class="card mb-3 card-upload">
            <div class="card-header py-2">Foto Barang</div>
            <div class="card-body py-2">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-3" title="Upload dari galeri" onclick="document.getElementById('fileUpload').click()"><i class="bi bi-upload text-muted"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-3" title="Ambil foto kamera" onclick="openCamera()"><i class="bi bi-camera text-muted"></i></button>
                    <div id="previewContainer" class="d-none">
                        <img id="imagePreview" src="" class="rounded" style="width:50px;height:50px;object-fit:cover">
                        <button type="button" class="btn btn-sm btn-link p-0 text-danger btn-reset-foto" title="Hapus foto" onclick="resetFile()"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
                <input type="file" id="fileUpload" name="foto" accept="image/*" class="d-none" onchange="previewFile(this)">
                <input type="file" id="cameraUpload" name="foto" accept="image/*" capture="environment" class="d-none" onchange="previewFile(this)">
            </div>
        </div>

        <div class="modal fade" id="cameraModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <span class="fw-semibold">Ambil Foto Kamera</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <video id="cameraVideo" autoplay playsinline style="width:100%;max-height:320px;border-radius:10px;background:#000"></video>
                        <canvas id="cameraCanvas" class="d-none"></canvas>
                        <div id="cameraMsg" class="text-muted small mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <div id="cameraPreviewWrap" class="d-none me-auto">
                            <img id="cameraPreview" class="rounded" style="width:64px;height:64px;object-fit:cover">
                        </div>
<button type="button" id="btnCapture" class="btn btn-success-soft rounded-pill">Ambil</button>
                    <button type="button" class="btn btn-outline-secondary rounded-pill ms-auto" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        let cameraStream = null;

        function openCamera() {
            if (!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)) {
                document.getElementById('cameraMsg').textContent = 'Kamera tidak didukung di perangkat ini. Membuka galeri...';
                document.getElementById('cameraUpload').click();
                return;
            }
            startCameraStream();
        }

        async function startCameraStream() {
            const m = new bootstrap.Modal(document.getElementById('cameraModal'));
            const video = document.getElementById('cameraVideo');
            const msg = document.getElementById('cameraMsg');
            const previewWrap = document.getElementById('cameraPreviewWrap');
            previewWrap.classList.add('d-none');
            stopCameraStream();
            try {
                cameraStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                video.srcObject = cameraStream;
                await video.play();
                msg.textContent = 'Arahkan kamera lalu tekan Ambil.';
                m.show();
            } catch (err) {
                msg.textContent = 'Izin kamera ditolak atau kamera tidak tersedia. Membuka galeri...';
                document.getElementById('cameraUpload').click();
            }
        }

        function capturePhoto() {
            const video = document.getElementById('cameraVideo');
            const canvas = document.getElementById('cameraCanvas');
            canvas.width = video.videoWidth || 640;
            canvas.height = video.videoHeight || 480;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.toBlob(blob => {
                if (!blob) return;
                const file = new File([blob], 'foto_camera.png', { type: 'image/png' });
                const dt = new DataTransfer();
                dt.items.add(file);
                const fileInput = document.getElementById('fileUpload');
                fileInput.files = dt.files;
                previewFile(fileInput);
                document.getElementById('cameraPreview').src = URL.createObjectURL(blob);
                document.getElementById('cameraPreviewWrap').classList.remove('d-none');
            }, 'image/png');
        }

        function stopCameraStream() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(t => t.stop());
                cameraStream = null;
            }
        }

        document.getElementById('btnCapture').addEventListener('click', capturePhoto);
        document.getElementById('cameraModal').addEventListener('hidden.bs.modal', stopCameraStream);

        function previewFile(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('previewContainer').classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        function resetFile() {
            document.getElementById('fileUpload').value = '';
            document.getElementById('cameraUpload').value = '';
            document.getElementById('previewContainer').classList.add('d-none');
        }
        </script>
        <div class="d-flex gap-3 justify-content-between align-items-center">
            <button type="submit" class="btn btn-success-soft px-4">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
    </div>
</div>
@endsection
