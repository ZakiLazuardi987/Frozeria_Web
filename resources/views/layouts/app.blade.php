<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Frozeria') | Frozeria Stok</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- AdminLTE --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> --}}

    {{-- Bootstrap 4 (sudah termasuk di AdminLTE, tapi kita link juga) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .navbar-brand span {
            color: #74c0fc;
        }

        .main-header.navbar {
            background-color: #1e3a5f;
            border-bottom: none;
            padding: 0 1rem;
        }

        .main-header .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            padding: 1rem 0.9rem !important;
            transition: color 0.2s;
        }

        .main-header .nav-link:hover,
        .main-header .nav-link.active {
            color: #fff !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 4px;
        }

        .content-wrapper {
            background-color: #f4f6f9;
            padding: 1.5rem;
        }

        /* Cards statistik */
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e3a5f;
        }

        .stat-card .stat-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        /* Badge kategori */
        .badge-kategori {
            background-color: #e8f4fd;
            color: #1e3a5f;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.78rem;
        }

        /* Stok labels */
        .stok-habis {
            color: #dc3545;
            font-weight: 600;
        }

        .stok-menipis {
            color: #fd7e14;
            font-weight: 600;
        }

        .stok-aman {
            color: #198754;
            font-weight: 600;
        }

        /* Table */
        .table-frozeria th {
            background-color: #f8f9fa;
            font-weight: 600;
            font-size: 0.85rem;
            color: #495057;
            border-top: none;
        }

        .table-frozeria td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* Card container */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem 1.25rem;
        }

        /* Modal konfirmasi */
        .modal-hapus .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .modal-hapus .modal-icon {
            font-size: 2.5rem;
            color: #fd7e14;
        }

        /* Alert */
        .alert {
            border-radius: 8px;
            border: none;
        }

        /* Pagination */
        .pagination .page-link {
            color: #1e3a5f;
        }

        .pagination .page-item.active .page-link {
            background-color: #1e3a5f;
            border-color: #1e3a5f;
        }

        /* Upload area */
        .upload-area {
            border: 2px dashed #ced4da;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background-color 0.2s;
            background-color: #fafafa;
        }

        .upload-area:hover {
            border-color: #1e3a5f;
            background-color: #f0f4ff;
        }

        .upload-area .upload-icon {
            font-size: 2rem;
            color: #adb5bd;
            margin-bottom: 0.5rem;
        }

        /* Foto preview */
        #foto-preview {
            max-height: 200px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Detail barang */
        .detail-field-label {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .detail-field-value {
            font-size: 1rem;
            font-weight: 600;
            color: #212529;
        }

        .detail-foto-box {
            width: 160px;
            height: 160px;
            border-radius: 10px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        .detail-foto-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-foto-box .no-foto-icon {
            font-size: 3rem;
            color: #adb5bd;
        }
    </style>

    @stack('styles')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand-md">
        <div class="container-fluid">
            {{-- Brand --}}
            <a href="{{ route('barang.index') }}" class="navbar-brand">
                <span><i class="fas fa-snowflake mr-1"></i>
                Frozeria Stok</span> 
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('barang.index') }}"
                           class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                            <i class="fas fa-th-large mr-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}"
                           class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                            <i class="fas fa-tags mr-1"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bantuan.index') }}"
                           class="nav-link {{ request()->routeIs('bantuan.*') ? 'active' : '' }}">
                            <i class="fas fa-question-circle mr-1"></i> Bantuan
                        </a>
                    </li>
                </ul>

                {{-- Tambah Barang di kanan --}}
                @unless(request()->routeIs('kategori.*'))
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('barang.create') }}" class="btn btn-sm btn-light font-weight-600 ml-2">
                            <i class="fas fa-plus mr-1"></i> Tambah Barang
                        </a>
                    </li>
                </ul>
                @endunless
            </div>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <div class="content-wrapper" style="min-height: 100vh; margin-left: 0;">
        <div class="container-fluid py-3">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

</div>

{{-- Modal Konfirmasi Hapus (Global) --}}
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 420px;">
        <div class="modal-content modal-hapus">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center pb-2">
                <div class="modal-icon mb-3">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5 class="font-weight-bold mb-2">Hapus barang?</h5>
                <p class="text-muted mb-0" id="modalHapusPesan">
                    Data akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                    Batal
                </button>
                <form id="formHapus" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script> --}}

<script>
    // Handler tombol hapus (global)
    $(document).on('click', '.btn-hapus', function () {
        const namaBarang = $(this).data('nama');
        const actionUrl  = $(this).data('action');
        const tipe       = $(this).data('tipe') || 'barang';

        let pesan = '';
        if (tipe === 'kategori') {
            pesan = `Data kategori <strong>${namaBarang}</strong> akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`;
            $('#modalHapus h5').text('Hapus kategori?');
        } else {
            pesan = `Data <strong>${namaBarang}</strong> akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`;
            $('#modalHapus h5').text('Hapus barang?');
        }

        $('#modalHapusPesan').html(pesan);
        $('#formHapus').attr('action', actionUrl);
        $('#modalHapus').modal('show');
    });

    // Auto-dismiss alert setelah 5 detik
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>

@stack('scripts')
</body>
</html>