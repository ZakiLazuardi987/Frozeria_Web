@extends('layouts.app')

@section('title', 'Bantuan')

@section('content')

<div class="mb-4">
    <h5 class="mb-0 font-weight-bold text-dark">Panduan Penggunaan Sistem</h5>
</div>

{{-- Cara menambah barang baru --}}
<div class="card mb-3">
    <div class="card-body">
        <h6 class="font-weight-bold mb-3">Cara menambah barang baru</h6>
        <ol class="mb-0 pl-3">
            <li class="mb-1">
                Buka halaman <strong>Dashboard</strong>, klik tombol <strong>+ Tambah Barang</strong> di kanan atas.
            </li>
            <li class="mb-1">
                Unggah foto barang (opsional), lalu isi formulir: nama, kategori, satuan, jumlah stok, harga, dan lainnya.
            </li>
            <li>
                Klik <strong>Simpan Barang</strong>. Barang akan muncul di daftar dashboard.
            </li>
        </ol>
    </div>
</div>

{{-- Cara update stok barang masuk --}}
<div class="card mb-3">
    <div class="card-body">
        <h6 class="font-weight-bold mb-3">Cara update stok barang masuk</h6>
        <ol class="mb-0 pl-3">
            <li class="mb-1">
                Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.
            </li>
            <li class="mb-1">
                Klik tombol <strong>Edit</strong> pada baris barang tersebut.
            </li>
            <li>
                Ubah nilai <strong>Jumlah stok</strong> sesuai kondisi saat ini, lalu klik <strong>Simpan Barang</strong>.
            </li>
        </ol>
    </div>
</div>

{{-- Cara mengelola kategori --}}
<div class="card mb-3">
    <div class="card-body">
        <h6 class="font-weight-bold mb-3">Cara mengelola kategori</h6>
        <ol class="mb-0 pl-3">
            <li class="mb-1">
                Buka halaman <strong>Kategori</strong> dari navigasi atas.
            </li>
            <li class="mb-1">
                Tambah, edit, atau hapus kategori sesuai kebutuhan toko.
            </li>
            <li>
                Menghapus kategori tidak akan menghapus barang — barang akan menjadi tidak berkategori.
            </li>
        </ol>
    </div>
</div>

{{-- Catatan satuan --}}
<div class="card mb-4">
    <div class="card-body">
        <p class="mb-0">
            <i class="fas fa-info-circle mr-1"></i>
            Satuan barang diisi bebas sesuai kebutuhan — misalnya: <strong>pcs</strong>, <strong>pack</strong>, <strong>box</strong>, <strong>kg</strong>, <strong>liter</strong>, dan lain-lain.
        </p>
    </div>
</div>

{{-- ============================================================ --}}
{{-- Informasi Developer — isi sesuai data diri kamu             --}}
{{-- ============================================================ --}}
<div class="card border-0" style="background-color: #1e3a5f; border-radius: 10px;">
    <div class="card-body p-4 text-white">
        <h6 class="font-weight-bold mb-3" style="color: #74c0fc;">
            <i class="fas fa-user-circle mr-2"></i> Informasi Developer
        </h6>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2">
                    <small style="color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.75rem;">Nama</small>
                    <div class="font-weight-500">Zaki Lazuardi Ferysa Putra</div>
                </div>
                <div class="mb-2">
                    <small style="color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.75rem;">NIM</small>
                    <div class="font-weight-500">2241720101</div>
                </div>
                <div class="mb-2">
                    <small style="color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.75rem;">Kelas</small>
                    <div class="font-weight-500">TI - 4B</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <small style="color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.75rem;">Alamat</small>
                    <div class="font-weight-500">Perum Bumi Mondorokok Raya BA 93</div>
                </div>
                <div class="mb-2">
                    <small style="color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.75rem;">Nomor Telepon</small>
                    <div class="font-weight-500">081547215029</div>
                </div>
                <div class="mb-2">
                    <small style="color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.75rem;">Email</small>
                    <div class="font-weight-500">zakilfp987@gmail.com</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection