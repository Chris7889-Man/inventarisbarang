@extends('layouts.app')
@section('title', 'Transaksi Barang')
@section('content')
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
                    <div class="d-flex flex-column gap-3">
                        <div class="card card-info border-0 rounded-4 p-3">
                            <div class="fw-semibold mb-2"><i class="bi bi-tags text-primary me-2"></i>Kategori</div>
                            <select id="kategori" name="kategori" class="form-select">
                                <option value="">-- Pilih Kategori --</option>
                                @php($cats = $barangs->pluck('kategori')->filter()->unique()->values())
                                @foreach($cats as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card border-0 rounded-4 p-3">
                            <div class="fw-semibold mb-2"><i class="bi bi-arrow-left-right text-primary me-2"></i>Jenis Transaksi</div>
                            <div class="d-flex gap-2">
                                <button type="button" id="btnMasuk" class="btn btn-success px-3 active"><i class="bi bi-arrow-down-short me-1"></i>Masuk</button>
                                <button type="button" id="btnKeluar" class="btn btn-outline-warning px-3"><i class="bi bi-arrow-up-short me-1"></i>Keluar</button>
                            </div>
                        </div>
                        <div class="card card-input border-0 rounded-4 p-3">
                            <div class="fw-semibold mb-2"><i class="bi bi-calculator text-primary me-2"></i>Jumlah Stok</div>
                            <input id="jumlah" name="jumlah" type="number" class="form-control text-center" min="1" value="1" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-upload border-0 rounded-4 p-2">
                        <div class="fw-semibold small mb-1"><i class="bi bi-card-text text-primary me-1"></i>Keterangan</div>
                        <textarea name="keterangan" class="form-control form-control-sm" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start mt-2">
                <button type="submit" id="submitButton" class="btn btn-outline-success px-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
<style>
    .baris-barang:hover { background-color: #f6f9fe; }
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

    function pilihTipe(jenis) {
        tipe.value = jenis;
        const masuk = jenis === 'masuk';
        btnMasuk.className = masuk ? 'btn btn-success px-4 active' : 'btn btn-outline-success px-4';
        btnKeluar.className = masuk ? 'btn btn-outline-warning px-4' : 'btn btn-warning px-4 active';
        submitButton.className = 'btn btn-secondary px-4 text-white';
        submitButton.innerHTML = masuk ? '<i class="bi bi-check-circle me-1"></i>Simpan Barang Masuk' : '<i class="bi bi-check-circle me-1"></i>Simpan Barang Keluar';
    }
    btnMasuk.addEventListener('click', () => pilihTipe('masuk'));
    btnKeluar.addEventListener('click', () => pilihTipe('keluar'));

    function filterTable() {
        const q = searchBarang.value.trim().toLowerCase();
        const cat = kategori.value.trim().toLowerCase();

        const isNumeric = /^\d+$/.test(q);

        let visible = [];
        baris.forEach(row => {
            const nomor = row.dataset.no;
            const nama = row.dataset.nama.toLowerCase();
            const kode = row.dataset.kode.toLowerCase();
            const rowKategori = row.dataset.kategori.toLowerCase();

            const matchKategori = !cat || rowKategori === cat;

            let matchText = true;
            if (q) {
                if (isNumeric) {
                    matchText = nomor === q;
                } else {
                    matchText = nama.includes(q) || kode.includes(q);
                }
            }

            const show = matchKategori && matchText;
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
        kategori.value = kat;

        if (kategori.value !== kat) {
            const o = new Option(kat, kat, true, true);
            kategori.add(o, undefined);
            kategori.value = kat;
        }
    }

    searchBarang.addEventListener('input', filterTable);
    kategori.addEventListener('change', filterTable);

    baris.forEach(row => {
        row.addEventListener('click', function() {
            selectRow(this);
        });
    });

    submitButton.addEventListener('click', () => { submitButton.className = 'btn btn-success px-4'; });
});
</script>
@endsection
