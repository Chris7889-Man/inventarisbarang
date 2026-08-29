@extends('layouts.app')
@section('content')
<div class="container-fluid"><h3>Edit Barang</h3><form method="POST" action="/barang/{{ $barang->id }}" class="bg-white p-4 rounded shadow-sm">@csrf @method('PUT')<div class="mb-3"><label class="form-label">Nama Barang</label><input name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required></div><div class="mb-3"><label class="form-label">Stok</label><input name="stok" type="number" class="form-control" value="{{ $barang->stok }}" required></div><button class="btn btn-primary">Update</button></form></div>
@endsection