@php($barangs = $barangs ?? collect())
<div class="card card-profil border-0 rounded-4 p-3 h-100 d-flex flex-column">
    <div class="input-group mb-3">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input type="text" id="searchBarang" class="form-control border-start-0" placeholder="Tulis no atau nama barang yang ingin digunakan !">
        <input type="hidden" id="barangId" name="barang_id">
    </div>
    <div class="table-responsive border rounded-4 bg-white w-100 flex-grow-1 card-tabel-list" style="overflow-y: auto;">
        <table class="table table-hover table-bordered-soft mb-0 text-center align-middle" id="tabelBarang">
            <thead class="position-sticky top-0 bg-white z-10">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th class="d-none d-md-table-cell">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $i => $b)
                <tr class="baris-barang" data-id="{{ $b->id }}" data-no="{{ $i + 1 }}" data-nama="{{ $b->nama_barang }}" data-kode="{{ $b->kode_barang }}" data-kategori="{{ $b->kategori }}" style="cursor:pointer">
                    <td class="text-center text-muted fw-semibold">{{ $i + 1 }}</td>
                    <td>
                        <small class="text-muted d-none">{{ $b->kode_barang }}</small>
                        <div class="fw-semibold">{{ $b->nama_barang }}</div>
                    </td>
                    <td class="d-none d-md-table-cell">{{ $b->kategori ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-muted text-center py-3">Belum ada data barang.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
