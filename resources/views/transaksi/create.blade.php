@extends('layouts.app')
@section('title', 'Transaksi Barang')
@section('content')
<style>
.create-transaksi-page .card-ringkas,
.create-transaksi-page .card-info,
.create-transaksi-page .card-input,
.create-transaksi-page .card-upload,
.create-transaksi-page .card-profil {
    background: #fff !important;
    border-color: #e2e8f0 !important;
}
</style>
<div class="create-transaksi-page">
<div class="card card-ringkas border-0 shadow-sm">
    <div class="card-header bg-white py-1">
        <h6 class="mb-0 fw-bold">Transaksi Barang</h6>
    </div>
    <div class="card-body p-2">
        @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <form method="POST" action="/transaksi" id="formTransaksi">
            @csrf
            <input id="tipe" name="tipe" type="hidden" value="masuk">
            <div class="row g-2 align-items-start">
                <div class="col-lg-8">
                    @include('components.tabel-barang', ['barangs' => $barangs])
                </div>
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-4">
                        <div class="card card-info border-0 rounded-4 p-3 card-circle-outline">
                            <div class="fw-semibold mb-2"><i class="bi bi-tags text-primary me-2"></i>Kategori</div>
                            <select id="kategori" name="kategori" class="form-select">
                                <option value="">-- Pilih Kategori --</option>
                                @php($cats = $barangs->pluck('kategori')->filter()->unique()->values())
                                @foreach($cats as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card card-info border-0 rounded-4 p-3 card-circle-outline">
                            <div class="fw-semibold mb-2"><i class="bi bi-calendar text-primary me-2"></i>Tanggal</div>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}">
                            <small class="text-muted mt-1">Kosongkan untuk tanggal & jam server otomatis.</small>
                        </div>
                        <div class="d-flex gap-5">
                            <button type="button" id="btnMasuk" class="btn btn-masuk-soft px-5 active"><i class="bi bi-arrow-down-short me-1"></i>Masuk</button>
                            <button type="button" id="btnKeluar" class="btn btn-soft-netral px-5 ms-6"><i class="bi bi-arrow-up-short me-1"></i>Keluar</button>
                        </div>
                        <div class="card card-input border-0 rounded-4 p-3 card-circle-outline">
                            <div class="fw-semibold mb-2"><i class="bi bi-calculator text-primary me-2"></i>Jumlah Stok</div>
                            <input id="jumlah" name="jumlah" type="number" class="form-control text-center" min="1" value="1" required>
                        </div>
                        <div class="card card-upload border-0 rounded-4 p-2 card-circle-outline">
                            <div class="fw-semibold small mb-1"><i class="bi bi-card-text text-primary me-1"></i>Keterangan</div>
                            <textarea name="keterangan" class="form-control form-control-sm" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                        </div>
                        <button type="submit" id="submitButton" class="animated-button w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                            </svg>
                            <span class="text">SIMPAN</span>
                            <span class="circle"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .baris-barang:hover { background-color: #f6f9fe; }
    #tabelBarang { font-size: .875rem; }
    #tabelBarang thead th { padding: .5rem .75rem; }
    #tabelBarang tbody td { padding: .45rem .75rem; }
    #tabelBarang th:nth-child(1) { width: 60px; }
    #tabelBarang th:nth-child(2) { width: 55%; }
    #tabelBarang th:nth-child(3) { width: 30%; }

    .animated-button.w-100 { justify-content: center; }

    .card-circle-outline {
        border-radius: 1rem !important;
        border: 1px solid #f0eadd !important;
    }

    @media (max-width: 991.98px) {
        .card-tabel-list { height: 60vh; }
    }

    .animated-button {
      position: relative;
      display: flex;
      align-items: center;
      gap: 4px;
      padding: 8px 16px;
      border: 1px solid #f0eadd;
      font-size: 12px;
      background-color: #ffffff;
      border-radius: 100px;
      font-weight: 600;
      color: #14532d;
      cursor: pointer;
      overflow: hidden;
      transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button svg {
      position: absolute;
      width: 16px;
      fill: #14532d;
      z-index: 9;
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button .arr-1 {
      right: 8px;
    }

    .animated-button .arr-2 {
      left: -25%;
    }

    .animated-button .circle {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 20px;
      height: 20px;
      background-color: #f0fdf4;
      border-radius: 50%;
      opacity: 0;
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button .text {
      position: relative;
      z-index: 1;
      transform: translateX(-12px);
      transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .animated-button:hover {
      box-shadow: 0 0 0 12px transparent;
      color: #14532d;
      border-radius: 12px;
    }

    .animated-button:hover .arr-1 {
      right: -25%;
    }

    .animated-button:hover .arr-2 {
      left: 12px;
    }

    .animated-button:hover .text {
      transform: translateX(12px);
    }

    .animated-button:hover svg {
      fill: #14532d;
    }

    .animated-button:active {
      scale: 0.95;
      box-shadow: 0 0 0 4px #86efac;
    }

    .animated-button:hover .circle { width: 200%; height: 200%; opacity: 1; }
    
    .animated-button.tipe-keluar .circle { background-color: #fffbeb; }
    .animated-button.tipe-keluar:hover { color: #92400e; }
    .animated-button.tipe-keluar:hover svg { fill: #92400e; }
    .animated-button.tipe-keluar:active { box-shadow: 0 0 0 4px #fffbeb; }

    </style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipe = document.getElementById('tipe');
    const btnMasuk = document.getElementById('btnMasuk');
    const btnKeluar = document.getElementById('btnKeluar');
    const submitButton = document.getElementById('submitButton');

    const baris = document.querySelectorAll('.baris-barang');
    const searchBarang = document.getElementById('searchBarang');
    const barangId = document.getElementById('barangId');
    const kategori = document.getElementById('kategori');
    let kategoriFiltered = false;

    function pilihTipe(jenis) {
        tipe.value = jenis;
        localStorage.setItem('tipeTransaksi', jenis);
        const masuk = jenis === 'masuk';
        btnMasuk.className = masuk ? 'btn btn-masuk-soft px-5 active' : 'btn btn-soft-netral px-5';
        btnKeluar.className = masuk ? 'btn btn-soft-netral px-5 ms-6' : 'btn btn-keluar-soft px-5 ms-6 active';
        const txtSpan = submitButton.querySelector('.text');
        if (txtSpan) {
            txtSpan.textContent = masuk ? 'SIMPAN MASUK' : 'SIMPAN KELUAR';
        }
        submitButton.classList.toggle('tipe-keluar', !masuk);
        submitButton.classList.toggle('tipe-masuk', masuk);
    }
    const savedTipe = localStorage.getItem('tipeTransaksi');
    if (savedTipe === 'masuk' || savedTipe === 'keluar') pilihTipe(savedTipe);
    btnMasuk.addEventListener('click', () => pilihTipe('masuk'));
    btnKeluar.addEventListener('click', () => pilihTipe('keluar'));

    function filterTable() {
        const q = searchBarang.value.trim().toLowerCase();
        const isNumeric = /^\d+$/.test(q);
        const catFilter = kategoriFiltered ? kategori.value.trim().toLowerCase() : '';

        let visible = [];
        baris.forEach(row => {
            const nomor = row.dataset.no;
            const nama = row.dataset.nama.toLowerCase();
            const kode = row.dataset.kode.toLowerCase();
            const rowKat = (row.dataset.kategori || '').toLowerCase();
            const rowNamaKode = nama.includes(q) || kode.includes(q);

            const matchCat = !catFilter || rowKat === catFilter;

            let matchText = true;
            if (q) {
                if (isNumeric) {
                    matchText = nomor === q;
                } else {
                    matchText = rowNamaKode;
                }
            }

            const show = matchCat && matchText;
            row.style.display = show ? '' : 'none';
            if (show) visible.push(row);
        });

        if (visible.length === 1) {
            selectRow(visible[0]);
        }
    }

    function selectRow(row) {
        baris.forEach(r => r.classList.remove('selected'));
        row.classList.add('selected');

        const id = row.dataset.id;
        const kat = row.dataset.kategori;

        barangId.value = id;

        kategoriFiltered = false;
        kategori.value = kat;

        if (kategori.value !== kat) {
            const o = new Option(kat, kat, true, true);
            kategori.add(o, undefined);
            kategori.value = kat;
        }
    }

    searchBarang.addEventListener('input', filterTable);
    kategori.addEventListener('change', function() {
        kategoriFiltered = !!kategori.value;
        filterTable();
    });

    baris.forEach(row => {
        row.addEventListener('click', function() {
            selectRow(this);
        });
    });
});
    </script>

@if (session('error'))
<div class="modal fade" id="errorModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title mb-0">⚠️ Peringatan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">{{ session('error') }}</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Coba Lagi</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(document.getElementById('errorModal')).show();
    });
</script>
@endif

</div>
@endsection
