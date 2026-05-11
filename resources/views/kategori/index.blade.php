@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0 font-weight-bold text-dark">Daftar Kategori</h5>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Kategori
    </a>
</div>

{{-- Pencarian --}}
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('kategori.index') }}" class="form-inline">
            <div class="input-group" style="max-width: 400px;">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari kategori..."
                       value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Kategori --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="pl-4">Nama kategori</th>
                        {{-- <th>Deskripsi</th> --}}
                        <th>Jumlah barang</th>
                        <th>Dibuat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr>
                            <td class="pl-4 font-weight-500">{{ $kategori->nama_kategori }}</td>
                            {{-- <td class="font-weight-500">{{ $kategori->deskripsi ?? '-' }}</td> --}}
                            <td>
                                <span class="text-muted">{{ $kategori->barangs_count }} barang</span>
                            </td>
                            <td class="text-muted" style="font-size:0.88rem;">
                                {{ $kategori->created_at ? $kategori->created_at->isoFormat('D MMM YYYY') : '-' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kategori.edit', $kategori) }}"
                                   class="btn btn-sm btn-outline-warning px-2">Edit</a>
                                <button class="btn btn-sm btn-outline-danger px-2 btn-hapus"
                                        data-nama="{{ $kategori->nama_kategori }}"
                                        data-action="{{ route('kategori.destroy', $kategori) }}"
                                        data-tipe="kategori">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-tags fa-2x d-block mb-2"></i>
                                Tidak ada kategori yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($kategoris->count() > 0)
        <div class="card-footer bg-white py-2">
            <small class="text-muted">{{ $kategoris->count() }} kategori terdaftar</small>
        </div>
    @endif
</div>

@endsection