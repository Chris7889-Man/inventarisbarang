@extends('layouts.app')
@section('title', 'Pengaturan')
@section('content')
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
</div>
@endsection
