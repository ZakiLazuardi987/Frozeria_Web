@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-outline-secondary mr-3">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
    <h5 class="mb-0 font-weight-bold text-dark">Tambah Kategori</h5>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-body p-4">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_kategori">Nama kategori <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('nama_kategori') is-invalid @enderror"
                       id="nama_kategori"
                       name="nama_kategori"
                       value="{{ old('nama_kategori') }}"
                       placeholder="Contoh: Ayam, Seafood, Sayuran..."
                       autofocus required>
                @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi (opsional)</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          id="deskripsi"
                          name="deskripsi"
                          rows="3"
                          placeholder="Produk berbahan dasar ayam beku...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-4 mr-2">Batal</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save mr-1"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@endsection