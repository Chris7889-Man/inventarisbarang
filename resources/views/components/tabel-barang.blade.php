@php($barangs = $barangs ?? collect())
<div class="card card-profil border-0 rounded-4 p-3 h-100 d-flex flex-column position-relative">
    <div class="mb-3">
        <div class="fw-semibold"><i class="bi bi-list-check text-primary me-2"></i>Daftar Barang</div>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input type="text" id="searchBarang" class="form-control border-start-0" placeholder="Cari barang...">
        <input type="hidden" id="barangId" name="barang_id">
    </div>
    <div class="border rounded-4 bg-white mb-4" style="flex:1 1 auto;overflow-y:auto;">
        <table class="table table-sm table-hover mb-0 align-middle" id="tabelBarang">
            <thead class="position-sticky top-0 bg-white z-10">
                <tr>
                    <th class="text-center py-2" style="width:70px">Nomor</th>
                    <th class="py-2">Nama Barang</th>
                    <th class="py-2">Kategori</th>
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
                    <td><span class="badge bg-light text-dark">{{ $b->kategori ?? '-' }}</span></td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-muted text-center py-3">Belum ada data barang.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <small id="selectedInfo" class="text-muted mt-2 d-none"><i class="bi bi-check-circle-fill text-success me-1"></i>Barang terpilih: <strong id="selectedName"></strong></small>
                        <small id="duplicateWarn" class="text-warning mt-2 d-none"><i class="bi bi-exclamation-triangle me-1"></i><span id="dupWarnText"></span></small>
</div>
