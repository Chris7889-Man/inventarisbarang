@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h3>Input Barang Baru</h3>
    <form method="POST" action="/barang" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-select">
                <option value="">Pilih kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori Baru</label>
            <input name="kategori_baru" class="form-control" placeholder="Isi jika kategori belum ada">
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Barang Lama</label>
            <input name="tanggal" type="date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input name="foto" type="file" class="form-control">
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
