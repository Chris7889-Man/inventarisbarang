@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card card-input mx-auto" style="max-width:720px;">
        <div class="card-header py-2">Edit Barang</div>
        <div class="card-body">
            <form method="POST" action="/barang/{{ $barang->id }}">
                @csrf
                @method('PUT')
                <div class="card card-profil mb-3">
                    <div class="card-header py-2">Nama Barang</div>
                    <div class="card-body py-2">
                        <input name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
                    </div>
                </div>
                <div class="card card-ringkas mb-3">
                    <div class="card-header py-2">Stok</div>
                    <div class="card-body py-2">
                        <input name="stok" type="number" class="form-control" value="{{ $barang->stok }}" required>
                    </div>
                </div>
                <div class="d-flex gap-3 justify-content-between align-items-center">
                    <button type="submit" class="btn btn-neutral-white rounded px-4" onmouseover="this.classList.replace('btn-neutral-white', 'btn-success-soft')" onmouseout="this.classList.replace('btn-success-soft', 'btn-neutral-white')">Update</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary rounded px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
