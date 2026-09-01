@extends('layouts.app')
@section('title', 'Transaksi Barang')
@section('content')
<div class="card card-ringkas border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-1 fw-bold">Transaksi Barang</h4>
        <p class="mb-3 text-muted small">Catat barang masuk atau barang keluar secara individual.</p>
        <div class="d-flex gap-2">
            <button type="button" id="btnMasuk" class="btn btn-success px-4 active"><i class="bi bi-arrow-down-short me-1"></i>Masuk</button>
            <button type="button" id="btnKeluar" class="btn btn-outline-warning px-4"><i class="bi bi-arrow-up-short me-1"></i>Keluar</button>
        </div>
    </div>
    <div class="card-body p-4">
        @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <form method="POST" action="/transaksi" id="formTransaksi">
            @csrf
            <input id="tipe" name="tipe" type="hidden" value="masuk">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    @include('components.tabel-barang', ['barangs' => $barangs])
                </div>
                <div class="col-lg-3">
                    <div class="card card-info border-0 rounded-4 p-3">
                        <div class="fw-semibold mb-3"><i class="bi bi-tags text-primary me-2"></i>Kategori</div>
                        <label class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @php($cats = $barangs->pluck('kategori')->filter()->unique()->values())
                            @foreach($cats as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                     <div class="card card-input border-0 rounded-4 p-3">
                        <div class="fw-semibold mb-3"><i class="bi bi-calculator text-primary me-2"></i>Jumlah Transaksi</div>
                        <label class="form-label">Jumlah</label>
                        <div class="input-group">
                            <button type="button" id="kurang" class="btn btn-outline-secondary"><i class="bi bi-dash-lg"></i></button>
                            <input id="jumlah" name="jumlah" type="number" class="form-control text-center" min="1" value="1" required>
                            <button type="button" id="tambahJumlah" class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i></button>
                        </div>
                        <small class="text-muted d-block mt-2">Gunakan tombol atau isi jumlah secara manual.</small>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-upload border-0 rounded-4 p-3">
                        <div class="fw-semibold mb-3"><i class="bi bi-card-text text-primary me-2"></i>Keterangan</div>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start mt-4">
                <button type="submit" id="submitButton" class="btn btn-outline-success px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>
<style>
    .selected { background-color: #d1fae5 !important; }
    .baris-barang:hover { background-color: #f8fafc; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipe = document.getElementById('tipe');
    const btnMasuk = document.getElementById('btnMasuk');
    const btnKeluar = document.getElementById('btnKeluar');
    const submitButton = document.getElementById('submitButton');
    
    const baris = document.querySelectorAll('.baris-barang');
    const searchBarang = document.getElementById('searchBarang');
    const selectedInfo = document.getElementById('selectedInfo');
    const duplicateWarn = document.getElementById('duplicateWarn');
    const dupWarnText = document.getElementById('dupWarnText');
    const barangId = document.getElementById('barangId');
    const kategori = document.getElementById('kategori');
    const selectedName = document.getElementById('selectedName');

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
        if (!q) {
            baris.forEach(row => row.style.display = '');
            return;
        }

        const isNumeric = /^\d+$/.test(q);

        let visible = [];
        baris.forEach(row => {
            const nomor = row.dataset.no;
            const nama = row.dataset.nama.toLowerCase();
            const kode = row.dataset.kode.toLowerCase();
            let match;
            if (isNumeric) {
                match = nomor === q;
            } else {
                match = nama.includes(q) || kode.includes(q);
            }
            row.style.display = match ? '' : 'none';
            if (match) visible.push(row);
        });

        if (visible.length === 1) {
            selectRow(visible[0]);
        }
    }

    function selectRow(row) {
        baris.forEach(r => r.classList.remove('selected'));
        row.classList.add('selected');

        const id = row.dataset.id;
        const nama = row.dataset.nama;
        const kode = row.dataset.kode;
        const kat = row.dataset.kategori;

        barangId.value = id;
        kategori.value = kat;

        if (kategori.value !== kat) {
            const o = new Option(kat, kat, true, true);
            kategori.add(o, undefined);
            kategori.value = kat;
        }

        selectedInfo.classList.remove('d-none');
        selectedName.textContent = nama + ' (' + kode + ')';

        let dupCount = 0;
        baris.forEach(r => {
            if (r.dataset.nama.toLowerCase() === nama.toLowerCase() &&
                r.dataset.kategori.toLowerCase() === kat.toLowerCase() && r !== row) {
                dupCount++;
            }
        });

        if (dupCount > 0) {
            duplicateWarn.classList.remove('d-none');
            dupWarnText.textContent = `Ada ${dupCount} barang lain dengan kategori "${kat}" dan nama "${nama}". Transaksi tetap bisa dilakukan.`;
        } else {
            duplicateWarn.classList.add('d-none');
        }
    }

    searchBarang.addEventListener('input', filterTable);

    baris.forEach(row => {
        row.addEventListener('click', function() {
            selectRow(this);
        });
    });

    const jumlah = document.getElementById('jumlah');
    document.getElementById('kurang').addEventListener('click', () => { jumlah.value = Math.max(1, Number(jumlah.value || 1) - 1); });
    document.getElementById('tambahJumlah').addEventListener('click', () => { jumlah.value = Number(jumlah.value || 0) + 1; });
    submitButton.addEventListener('click', () => { submitButton.className = 'btn btn-success px-4'; });
});
</script>
@endsection
