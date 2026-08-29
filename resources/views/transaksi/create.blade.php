@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h3>Transaksi Barang</h3>
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="/transaksi" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <input id="tipe" name="tipe" type="hidden" value="masuk">
        <div class="mb-3">
            <label class="form-label">No / Nama Barang</label>
            <input id="cariBarang" class="form-control" list="daftarBarang" placeholder="Ketik kode atau nama barang" required>
            <input id="barangId" name="barang_id" type="hidden">
            <datalist id="daftarBarang">
                @foreach($barangs as $barang)
                    <option value="{{ $barang->kode_barang }} - {{ $barang->nama_barang }}" data-id="{{ $barang->id }}" data-kategori="{{ $barang->kategori }}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input id="kategori" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input name="jumlah" type="number" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button id="tambah" type="submit" class="btn btn-success me-2"><i class="bi bi-plus-circle me-1"></i>Tambah</button>
        <button id="keluar" type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-up-right me-1"></i>Keluar</button>
    </form>
</div>
<script>
const input = document.getElementById('cariBarang');
const barangId = document.getElementById('barangId');
const kategori = document.getElementById('kategori');
const tipe = document.getElementById('tipe');
function pilihBarang() {
    const option = [...document.querySelectorAll('#daftarBarang option')].find(item => item.value === input.value);
    barangId.value = option ? option.dataset.id : '';
    kategori.value = option ? option.dataset.kategori : '';
}
input.addEventListener('input', pilihBarang);
document.getElementById('tambah').addEventListener('click', () => tipe.value = 'masuk');
document.getElementById('keluar').addEventListener('click', () => tipe.value = 'keluar');
</script>
@endsection
