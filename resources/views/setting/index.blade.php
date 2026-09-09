@extends('layouts.app')
@section('title', 'Pengaturan')
@section('content')
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<div class="row justify-content-center g-4">
    <div class="col-md-10 col-lg-5">
        <div class="card h-100">
            <div class="card-header"><i class="bi bi-translate text-primary me-2"></i>Bahasa Aplikasi</div>
            <div class="card-body p-4">
                <p class="text-muted small">Pilih bahasa yang digunakan di seluruh aplikasi.</p>
                <form method="POST" action="{{ route('setting.update') }}">
                    @csrf
                    <select name="bahasa" class="form-select" onchange="this.form.submit()">
                        <option value="id" {{ session('lang', 'id') === 'id' ? 'selected' : '' }}>Indonesia</option>
                        <option value="ms" {{ session('lang') === 'ms' ? 'selected' : '' }}>Melayu</option>
                        <option value="en" {{ session('lang') === 'en' ? 'selected' : '' }}>English</option>
                        <option value="ja" {{ session('lang') === 'ja' ? 'selected' : '' }}>日本語</option>
                        <option value="zh" {{ session('lang') === 'zh' ? 'selected' : '' }}>中文</option>
                        <option value="ar" {{ session('lang') === 'ar' ? 'selected' : '' }}>العربية</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-lg-5">
        <div class="card h-100">
            <div class="card-header"><i class="bi bi-type text-primary me-2"></i>Ukuran Tulisan</div>
            <div class="card-body p-4">
                <p class="text-muted small">Atur ukuran tulisan sesuai kenyamanan Anda.</p>
                <form method="POST" action="{{ route('setting.update') }}">
                    @csrf
                    <select name="font_size" class="form-select" onchange="this.form.submit()">
                        <option value="xs" {{ session('font_size') === 'xs' ? 'selected' : '' }}>Sangat Kecil</option>
                        <option value="sm" {{ session('font_size') === 'sm' ? 'selected' : '' }}>Kecil</option>
                        <option value="md" {{ session('font_size', 'md') === 'md' ? 'selected' : '' }}>Sedang</option>
                        <option value="lg" {{ session('font_size') === 'lg' ? 'selected' : '' }}>Besar</option>
                        <option value="xl" {{ session('font_size') === 'xl' ? 'selected' : '' }}>Sangat Besar</option>
                        <option value="xxl" {{ session('font_size') === 'xxl' ? 'selected' : '' }}>Ekstra Besar</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-white"><i class="bi bi-google text-danger me-2"></i>Integrasi Google Drive</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">ID Folder Utama Google Drive</label>
                        <input type="text" name="drive_root_folder_id" class="form-control" value="{{ $setting->drive_root_folder_id ?? '' }}" placeholder="Contoh: 1A2b3C4d5E6f7G8h9I0jK">
                        <small class="text-muted">ID folder utama di mana semua foto barang akan disimpan.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Default untuk Share Drive</label>
                        <input type="email" name="default_email" class="form-control" value="{{ $setting->default_email ?? '' }}" placeholder="example@email.com">
                        <small class="text-muted">Email ini akan otomatis diberi akses ke folder barang di Drive saat upload foto.</small>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPassword"><i class="bi bi-save me-1"></i>Simpan Pengaturan Drive</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPassword" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title mb-0"><i class="bi bi-lock-fill me-2"></i>Verifikasi Keamanan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4">
                <p>Silakan masukkan password admin untuk mengonfirmasi perubahan pengaturan Drive.</p>
                <input type="password" id="inputPassword" class="form-control" placeholder="Masukkan password Anda">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="submitDriveForm()">Konfirmasi & Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
function submitDriveForm() {
    const password = document.getElementById('inputPassword').value;
    if (!password) {
        alert('Password harus diisi');
        return;
    }
    const form = document.querySelector('form[action="{{ route("setting.update") }}"]:has(input[name="default_email"])');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'password_confirm';
    input.value = password;
    form.appendChild(input);
    form.submit();
}
</script>
@endsection
