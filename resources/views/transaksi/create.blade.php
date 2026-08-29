@extends('layouts.app')
@section('title', 'Transaksi Barang')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h4 class="mb-1 fw-bold">Transaksi Barang</h4>
        <p class="mb-3 text-muted small">Catat barang masuk atau barang keluar secara individual.</p>
        <div class="d-flex gap-2">
            <button type="button" id="btnMasuk" class="btn btn-success px-4 active"><i class="bi bi-plus-circle me-1"></i>Masuk</button>
            <button type="button" id="btnKeluar" class="btn btn-outline-danger px-4"><i class="bi bi-dash-circle me-1"></i>Keluar</button>
        </div>
    </div>
    <div class="card-body p-4">
        @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <form method="POST" action="/transaksi" id="formTransaksi">
            @csrf
            <input id="tipe" name="tipe" type="hidden" value="masuk">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                        <div class="fw-semibold mb-3"><i class="bi bi-box-seam text-primary me-2"></i>Data Barang</div>
                        <label class="form-label">No / Nama Barang</label>
                        <input id="cariBarang" class="form-control" list="daftarBarang" placeholder="Ketik kode atau nama barang" required>
                        <input id="barangId" name="barang_id" type="hidden">
                        <datalist id="daftarBarang">@foreach($barangs as $barang)<option value="{{ $barang->kode_barang }} - {{ $barang->nama_barang }}" data-id="{{ $barang->id }}" data-kategori="{{ $barang->kategori }}"></option>@endforeach</datalist>
                        <label class="form-label mt-3">Kategori</label>
                        <input id="kategori" class="form-control" readonly placeholder="Otomatis mengikuti barang">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="border rounded-4 p-3 h-100 bg-light-subtle">
                        <div class="fw-semibold mb-3"><i class="bi bi-calculator text-primary me-2"></i>Jumlah Transaksi</div>
                        <label class="form-label">Jumlah</label>
                        <div class="input-group input-group-lg">
                            <button type="button" id="kurang" class="btn btn-outline-secondary"><i class="bi bi-dash-lg"></i></button>
                            <input id="jumlah" name="jumlah" type="number" class="form-control text-center" min="1" value="1" required>
                            <button type="button" id="tambahJumlah" class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i></button>
                        </div>
                        <small class="text-muted d-block mt-2">Gunakan tombol atau isi jumlah secara manual.</small>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border rounded-4 p-3 bg-light-subtle">
                        <div class="fw-semibold mb-3"><i class="bi bi-card-text text-primary me-2"></i>Keterangan</div>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" id="submitButton" class="btn btn-success px-4"><i class="bi bi-check-circle me-1"></i>Simpan Barang Masuk</button>
            </div>
        </form>
    </div>
</div>
<script>
const tipe = document.getElementById('tipe');
const btnMasuk = document.getElementById('btnMasuk');
const btnKeluar = document.getElementById('btnKeluar');
const submitButton = document.getElementById('submitButton');
function pilihTipe(jenis) {
    tipe.value = jenis;
    const masuk = jenis === 'masuk';
    btnMasuk.className = masuk ? 'btn btn-success px-4 active' : 'btn btn-outline-success px-4';
    btnKeluar.className = masuk ? 'btn btn-outline-danger px-4' : 'btn btn-danger px-4 active';
    submitButton.className = masuk ? 'btn btn-success px-4' : 'btn btn-danger px-4';
    submitButton.innerHTML = masuk ? '<i class="bi bi-check-circle me-1"></i>Simpan Barang Masuk' : '<i class="bi bi-check-circle me-1"></i>Simpan Barang Keluar';
}
btnMasuk.addEventListener('click', () => pilihTipe('masuk'));
btnKeluar.addEventListener('click', () => pilihTipe('keluar'));
const input = document.getElementById('cariBarang');
const barangId = document.getElementById('barangId');
const kategori = document.getElementById('kategori');
input.addEventListener('input', () => {
    const option = [...document.querySelectorAll('#daftarBarang option')].find(item => item.value === input.value);
    barangId.value = option ? option.dataset.id : '';
    kategori.value = option ? option.dataset.kategori : '';
});
const jumlah = document.getElementById('jumlah');
document.getElementById('kurang').addEventListener('click', () => { jumlah.value = Math.max(1, Number(jumlah.value || 1) - 1); });
document.getElementById('tambahJumlah').addEventListener('click', () => { jumlah.value = Number(jumlah.value || 0) + 1; });
</script>
@endsection
