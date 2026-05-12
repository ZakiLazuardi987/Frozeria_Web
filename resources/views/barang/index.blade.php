@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Header halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 font-weight-bold text-dark">
        <i class="fas fa-th-large mr-2 text-primary"></i>Dashboard
    </h4>
</div>

{{-- Kartu Statistik --}}
<div class="row mb-4">
    <div class="col-6 col-md-3 mb-3">
        <div class="card stat-card h-100">
            <div class="card-body py-3 px-4">
                <div class="stat-label mb-1">Total barang</div>
                <div class="stat-value">{{ $totalBarang }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card stat-card h-100">
            <div class="card-body py-3 px-4">
                <div class="stat-label mb-1">Total kategori</div>
                <div class="stat-value">{{ $totalKategori }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card stat-card h-100">
            <div class="card-body py-3 px-4">
                <div class="stat-label mb-1">Stok menipis</div>
                <div class="stat-value text-warning">{{ $stokMenipis }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card stat-card h-100">
            <div class="card-body py-3 px-4">
                <div class="stat-label mb-1">Stok habis</div>
                {{-- @if ($stokHabis > 0)
                    <div class="stat-value text-danger">{{ $stokHabis }}</div>
                @elseif ($stokHabis = 0)
                    <div class="stat-value text-success">{{ $stokHabis }}</div>
                @endif --}}
                <div class="stat-value text-danger">{{ $stokHabis }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Pencarian --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('barang.index') }}" class="form-inline flex-wrap" id="formFilter">
            <div class="input-group mr-2 mb-2 w-75">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari nama barang..."
                       value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                </div>
            </div>

            <select name="kategori_id" class="form-control mb-2" onchange="this.form.submit()" style="width: 24%;">
                <option value="">Semua kategori</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>

            @if(request('search') || request('kategori_id'))
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary ml-2 mb-2">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </form>
    </div>
</div>

{{-- Tabel Barang --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-frozeria mb-0">
                <thead>
                    <tr>
                        <th class="pl-4">Nama barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga jual</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                        {{-- <th class="pl-4">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama_barang', 'dir' => request('sort') == 'nama_barang' && request('dir') == 'asc' ? 'desc' : 'asc']) }}" class="text-dark">
                                Nama barang
                                <i class="fas fa-sort ml-1"></i>
                            </a>
                        </th> --}}
                <tbody>
                    @forelse($barangs as $barang)
                        <tr>
                            <td class="pl-4 font-weight-500">{{ $barang->nama_barang }}</td>
                            <td>
                                <span class="badge-kategori">
                                    {{ $barang->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @if($barang->isStokHabis())
                                    <span class="stok-habis">{{ $barang->jumlah_stok }}</span>
                                @elseif($barang->isStokMenipis())
                                    <span class="stok-menipis">{{ $barang->jumlah_stok }}</span>
                                @else
                                    <span class="stok-aman">{{ $barang->jumlah_stok }}</span>
                                @endif
                            </td>
                            <td>{{ $barang->satuan }}</td>
                            <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('barang.show', $barang) }}"
                                   class="btn btn-sm btn-outline-info px-2">Detail</a>
                                <a href="{{ route('barang.edit', $barang) }}"
                                   class="btn btn-sm btn-outline-warning px-2">Edit</a>
                                <button class="btn btn-sm btn-outline-danger px-2 btn-hapus"
                                        data-nama="{{ $barang->nama_barang }}"
                                        data-action="{{ route('barang.destroy', $barang) }}"
                                        data-tipe="barang">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                                Tidak ada barang yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($barangs->total() > 0)
        <div class="card-footer d-flex justify-content-between align-items-center bg-white py-2">
            <small class="text-muted">
                Menampilkan {{ $barangs->firstItem() }}–{{ $barangs->lastItem() }} dari {{ $barangs->total() }} barang
            </small>
            {{ $barangs->links() }}
        </div>
    @endif
</div>

@endsection