@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-secondary mr-2">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <span class="font-weight-bold text-dark">Detail Barang</span>
    </div>
    <div>
        <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning btn-sm mr-1">
            <i class="fas fa-edit mr-1"></i> Edit Barang
        </a>
        <button class="btn btn-danger btn-sm btn-hapus"
                data-nama="{{ $barang->nama_barang }}"
                data-action="{{ route('barang.destroy', $barang) }}"
                data-tipe="barang">
            <i class="fas fa-trash mr-1"></i> Hapus
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-4">

        {{-- Foto & Nama --}}
        <div class="d-flex align-items-start mb-4">
            <div class="detail-foto-box mr-4 flex-shrink-0">
                @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}"
                         alt="{{ $barang->nama_barang }}">
                @else
                    <i class="fas fa-image no-foto-icon"></i>
                @endif
            </div>
            <div>
                <h4 class="font-weight-bold mb-1">{{ $barang->nama_barang }}</h4>
                <span class="badge-kategori">
                    {{ $barang->kategori->nama_kategori ?? '-' }}
                </span>

                @if($barang->isStokHabis())
                    <span class="badge badge-danger ml-2">Stok Habis</span>
                @elseif($barang->isStokMenipis())
                    <span class="badge badge-warning ml-2">Stok Menipis</span>
                @else
                    <span class="badge badge-success ml-2">Stok Aman</span>
                @endif
            </div>
        </div>

        <hr>

        {{-- Detail Fields --}}
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded">
                    <div class="detail-field-label">Jumlah stok</div>
                    <div class="detail-field-value
                        @if($barang->isStokHabis()) stok-habis
                        @elseif($barang->isStokMenipis()) stok-menipis
                        @else stok-aman @endif">
                        {{ $barang->jumlah_stok }} {{ $barang->satuan }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded">
                    <div class="detail-field-label">Stok minimum</div>
                    <div class="detail-field-value">{{ $barang->stok_minimum }} {{ $barang->satuan }}</div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded">
                    <div class="detail-field-label">Harga jual</div>
                    <div class="detail-field-value">{{ $barang->harga_jual_format }}</div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded">
                    <div class="detail-field-label">Harga beli</div>
                    <div class="detail-field-value">{{ $barang->harga_beli_format }}</div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded">
                    <div class="detail-field-label">Berat / ukuran</div>
                    <div class="detail-field-value">{{ $barang->berat_ukuran ?: '-' }}</div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-3 border rounded">
                    <div class="detail-field-label">Lokasi simpan</div>
                    <div class="detail-field-value">{{ $barang->lokasi_simpan ?: '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        @if($barang->deskripsi)
            <div class="p-3 border rounded">
                <div class="detail-field-label mb-1">Deskripsi</div>
                <p class="mb-0" style="font-size: 0.9rem; color: #495057;">{{ $barang->deskripsi }}</p>
            </div>
        @endif
    </div>
</div>

@endsection