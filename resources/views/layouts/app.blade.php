<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Inventaris BPKP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root{
            --navy:#092b57;
            --navy-dark:#061c3a;
            --accent:#2f80ed;
            --surface:#f4f7fb;
            --slate-50:#f8fafc;
            --slate-100:#f1f5f9;
            --slate-600:#475569;
            --slate-700:#334155
        }
        body{
            background:var(--surface);
            font-family:Inter,system-ui,sans-serif;
            color:#213547
        }
        .app-shell{min-height:100vh}
        .sidebar{
            width:270px;
            background:linear-gradient(180deg,var(--navy-dark),var(--navy));
            position:fixed;
            inset:0 auto 0 0;
            z-index:1040;
            box-shadow:5px 0 20px #0016301a
        }
        .brand{
            border-bottom:1px solid #ffffff1f
        }
        .brand img{
            max-height:72px;
            max-width:145px;
            object-fit:contain
        }
        .nav-label{
            font-size:.68rem;
            letter-spacing:.1em;
            color:#b9cbe3;
            font-weight:700
        }
        .side-link{
            color:#d9e6f8;
            text-decoration:none;
            border-radius:10px;
            padding:.72rem .85rem;
            display:block;
            margin:.2rem 0;
            transition:.2s
        }
        .side-link:hover,.side-link.active{
            color:#fff;
            background:#ffffff1c
        }
        .side-link.active{
            box-shadow:inset 3px 0 #5aa1ff
        }
        .page{margin-left:270px;min-height:100vh}
        .topbar{
            height:74px;
            background:#fff;
            border-bottom:1px solid #e6edf5
        }
        .content{padding:2rem}
        .page-title{font-size:1.45rem;font-weight:700;margin:0}
        .page-subtitle{color:#718096;font-size:.9rem}
        .card,.table{background:#fff;border:0;border-radius:14px;box-shadow:0 4px 18px #1b365d0d}
        .card{overflow:hidden}
        .card-header{background:#f8fafc;border-bottom:1px solid #e6edf5;font-weight:600;padding:1rem 1.25rem;color:#334155}
        .btn{transition:all .2s;box-shadow:0 2px 6px #00000012;border:none}
        .btn-primary{background:#f59e0b;color:#1c1917}
        .btn-primary:hover{background:#d97706;color:#fff}
        .btn-warning{background:#f59e0b;color:#1c1917;font-weight:600}
        .btn-warning:hover{background:#d97706;color:#fff}
        .btn-outline-warning{border:1px solid #f59e0b;color:#b45309}
        .btn-outline-warning:hover{background:#f59e0b;color:#1c1917}
        .table thead th{
            background:#f1f5f9;
            color:#475569;
            border-bottom:2px solid #e6edf5;
            font-size:.72rem;
            letter-spacing:.04em;
            text-transform:uppercase;
            padding:1rem;
            font-weight:600
        }
        .table td{
            padding:1rem 1.1rem;
            vertical-align:middle;
            color:#3c4a5a;
            border-top:1px solid #eef2f7
        }
        .table-hover tbody tr:hover{background:#f6f9fe}
        .table-bordered-soft>thead th, .table-bordered-soft>tbody td { border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; }
        .table-bordered-soft>thead th:first-child, .table-bordered-soft>tbody td:first-child { border-left: 1px solid #e2e8f0; }
        .table-bordered-soft>tbody tr:last-child td { border-bottom: 1px solid #e2e8f0; }
        .table-bordered-soft>thead th:last-child, .table-bordered-soft>tbody td:last-child { border-right: none; }
        .user-avatar{
            width:38px;
            height:38px;
            background:#e8f1ff;
            color:#1769d1;
            border-radius:50%;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            font-weight:700
        }
        @media(max-width:991px){
            .sidebar{transform:translateX(-100%);transition:.25s}
            .sidebar.show{transform:translateX(0)}
            .page{margin-left:0}
            .content{padding:1rem !important}
            .btn{padding:.4rem .8rem!important}
        }
        @media(min-width:992px){
            .menu-toggle{display:none!important}
        }
        /* Responsif sangat kecil (HP) */
        @media(max-width:575px){
            .page-title{font-size:1.1rem}
            .content{padding:.75rem!important}
            .modal-dialog{margin:0}
            .modal-content{border-radius:0;min-height:100vh}
            .modal-body{padding:1rem}
            .btn-success-soft,.btn-outline-secondary{width:100%}
        }
        /* ===== CARD WARNA & GLOW (konsisten #FAF6F0) ===== */
        .card-profil, .card-input, .card-upload, .card-info, .card-ringkas {
            background: #FAF6F0;
            border: 1px solid #f0eadd;
            transition: all .3s ease;
        }
        .card-profil:hover, .card-input:hover, .card-upload:hover, .card-info:hover, .card-ringkas:hover,
        .card-profil:focus-within, .card-input:focus-within, .card-upload:focus-within, .card-info:focus-within, .card-ringkas:focus-within,
        .card-profil.active-card, .card-input.active-card, .card-upload.active-card, .card-info.active-card, .card-ringkas.active-card {
            box-shadow: 0 0 15px 4px rgba(245,158,11,.15);
            border-color: #e0d8c8;
            transform: translateY(-2px);
        }

/* Warna soft */
        .btn-success-soft {
            background: #d1fae5; /* hijau pastel */
            color: #065f46; /* hijau tua untuk teks */
            border: 1px solid #6ee7b7;
        }
        .btn-success-soft:hover {
            background: #a7f3d0;
            color: #064e3b;
        }
        /* Warna soft untuk ikon kamera dan aksi kecil */
        .foto-action-icon {
            color: #64748b; /* abu-abu soft */
            transition: color .2s;
        }
        .foto-action-icon:hover {
            color: #2563eb;
        }
    </style>
</head>
<body style="font-size:{{ match(session('font_size')) { 'xs' => '12px', 'sm' => '14px', 'lg' => '18px', 'xl' => '21px', 'xxl' => '24px', default => '16px' } }}"><div class="app-shell"><aside id="sidebar" class="sidebar text-white"><div class="brand text-center p-4"><img src="/image.png" alt="Logo BPKP" class="img-fluid"><div class="mt-2 fw-semibold">Inventaris BPKP</div><small class="text-white-50">Sistem Manajemen Barang</small></div><nav class="p-3"><div class="nav-label px-2 mb-2">MENU UTAMA</div><a class="side-link {{ Request::is('transaksi') ? 'active' : '' }}" href="/transaksi"><i class="bi bi-list-task me-3"></i>Daftar Transaksi</a><a class="side-link {{ Request::is('barang*') ? 'active' : '' }}" href="/barang"><i class="bi bi-box-seam me-3"></i>Daftar Barang</a><a class="side-link {{ Request::is('transaksi/create') ? 'active' : '' }}" href="/transaksi/create"><i class="bi bi-arrow-left-right me-3"></i>Transaksi</a><a class="side-link {{ Request::is('riwayat') ? 'active' : '' }}" href="/riwayat"><i class="bi bi-clock-history me-3"></i>Riwayat</a><div class="nav-label px-2 mt-4 mb-2">SISTEM</div><a class="side-link {{ Request::is('setting') ? 'active' : '' }}" href="/setting"><i class="bi bi-gear me-3"></i>{{ __('app.settings') }}</a><form id="logoutForm" action="/logout" method="POST">@csrf</form><a class="side-link text-danger" href="#" onclick="event.preventDefault();document.getElementById('logoutForm').submit()"><i class="bi bi-box-arrow-left me-3"></i>Logout</a></nav></aside><section class="page"><header class="topbar d-flex align-items-center justify-content-between px-3 px-lg-4"><button id="menuToggle" class="menu-toggle btn btn-light border"><i class="bi bi-list fs-5"></i></button><div><h1 class="page-title">@yield('title', 'Inventaris Barang')</h1><div class="page-subtitle">Badan Pengawasan Keuangan dan Pembangunan</div></div><div class="d-flex align-items-center gap-2"><span class="d-none d-sm-inline text-end"><small class="d-block text-muted">{{ auth()->user()->role ?? 'Pengguna' }}</small><strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong></span><span class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span></div></header><main class="content">@yield('content')</main></section></div><style>
        .cursor-pointer{cursor:pointer}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="modal fade" id="fotoPopupModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center">
                    <img src="" id="fotoPopupImg" class="img-fluid rounded-4 shadow-lg" alt="Preview Foto">
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('click', function (e) {
        const trigger = e.target.closest('.foto-popup-trigger');
        if (!trigger) return;
        const src = trigger.dataset.src;
        if (!src || src === '#') return;
        document.getElementById('fotoPopupImg').src = src;
        new bootstrap.Modal(document.getElementById('fotoPopupModal')).show();
    });
    document.getElementById('menuToggle').addEventListener('click',()=>document.getElementById('sidebar').classList.toggle('show'))
    </script>
</body></html>