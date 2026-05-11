@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('barang.show', $barang) }}" class="btn btn-sm btn-outline-secondary mr-3">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
    <h5 class="mb-0 font-weight-bold text-dark">Edit Barang</h5>
</div>

<form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Foto Barang --}}
    <div class="card mb-4">
        <div class="card-body p-4">
            <h6 class="font-weight-bold mb-3">Foto barang</h6>
            <div class="border rounded p-4 text-center"
                 style="border-style: dashed !important; background:#fafafa; cursor:pointer;"
                 id="dropZone"
                 onclick="document.getElementById('foto').click()">
                <div id="previewWrapper" class="{{ $barang->foto ? '' : 'd-none' }} mb-3">
                    <img id="previewImg"
                         src="{{ $barang->foto ? asset('storage/' . $barang->foto) : '#' }}"
                         alt="Preview"
                         class="img-fluid rounded" style="max-height:200px; object-fit:contain;">
                </div>
                <div id="uploadPlaceholder" class="{{ $barang->foto ? 'd-none' : '' }}">
                    <i class="fas fa-image fa-2x text-secondary"></i>
                    <p class="text-muted small mt-2 mb-1">Klik untuk memilih foto baru, atau seret file ke sini</p>
                    <p class="text-muted" style="font-size:0.78rem;">Format JPG, PNG — Maks. 2 MB</p>
                </div>
                @if($barang->foto)
                    <p class="text-muted small mt-2 mb-1">Pilih foto baru untuk mengganti foto saat ini</p>
                @endif
                <button type="button" class="btn btn-sm btn-outline-primary mt-1"
                        onclick="event.stopPropagation(); document.getElementById('foto').click()">
                    <i class="fas fa-upload mr-1"></i> Pilih Foto
                </button>
                <input type="file" id="foto" name="foto" class="d-none" accept="image/jpg,image/jpeg,image/png">
            </div>
            @error('foto')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Data Barang --}}
    <div class="card mb-4">
        <div class="card-body p-4">
            <h6 class="font-weight-bold mb-3">Informasi Barang</h6>

            <div class="form-group">
                <label for="nama_barang">Nama barang <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('nama_barang') is-invalid @enderror"
                       id="nama_barang" name="nama_barang"
                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                       placeholder="Contoh: Ayam nugget crispy" required>
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror"
                                id="kategori_id" name="kategori_id" required>
                            <option value="">Pilih kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ old('kategori_id', $barang->kategori_id) == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="satuan">Satuan <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('satuan') is-invalid @enderror"
                               id="satuan" name="satuan"
                               value="{{ old('satuan', $barang->satuan) }}"
                               placeholder="pcs, pack, kg, box..." required>
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jumlah_stok">Jumlah stok <span class="text-danger">*</span></label>
                        <input type="number"
                               class="form-control @error('jumlah_stok') is-invalid @enderror"
                               id="jumlah_stok" name="jumlah_stok"
                               value="{{ old('jumlah_stok', $barang->jumlah_stok) }}"
                               min="0" required>
                        @error('jumlah_stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stok_minimum">Stok minimum</label>
                        <input type="number"
                               class="form-control @error('stok_minimum') is-invalid @enderror"
                               id="stok_minimum" name="stok_minimum"
                               value="{{ old('stok_minimum', $barang->stok_minimum) }}"
                               min="0">
                        @error('stok_minimum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_jual">Harga jual (Rp) <span class="text-danger">*</span></label>
                        <input type="number"
                               class="form-control @error('harga_jual') is-invalid @enderror"
                               id="harga_jual" name="harga_jual"
                               value="{{ old('harga_jual', (int)$barang->harga_jual) }}"
                               min="0" step="100" required>
                        @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_beli">Harga beli (Rp)</label>
                        <input type="number"
                               class="form-control @error('harga_beli') is-invalid @enderror"
                               id="harga_beli" name="harga_beli"
                               value="{{ old('harga_beli', (int)$barang->harga_beli) }}"
                               min="0" step="100">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="berat_ukuran">Berat / ukuran</label>
                        <input type="text"
                               class="form-control @error('berat_ukuran') is-invalid @enderror"
                               id="berat_ukuran" name="berat_ukuran"
                               value="{{ old('berat_ukuran', $barang->berat_ukuran) }}"
                               placeholder="Contoh: 500 gram, 1 kg">
                        @error('berat_ukuran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lokasi_simpan">Lokasi simpan</label>
                        <input type="text"
                               class="form-control @error('lokasi_simpan') is-invalid @enderror"
                               id="lokasi_simpan" name="lokasi_simpan"
                               value="{{ old('lokasi_simpan', $barang->lokasi_simpan) }}"
                               placeholder="Contoh: Rak A-3">
                        @error('lokasi_simpan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mb-0">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          id="deskripsi" name="deskripsi"
                          rows="3"
                          placeholder="Deskripsi singkat tentang barang ini...">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex justify-content-end mb-5">
        <a href="{{ route('barang.show', $barang) }}" class="btn btn-outline-secondary px-4 mr-2">Batal</a>
        <button type="submit" class="btn btn-primary px-4">
            <i class="fas fa-save mr-1"></i> Simpan Barang
        </button>
    </div>
</form>

@endsection

@push('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('previewImg').src = evt.target.result;
                document.getElementById('previewWrapper').classList.remove('d-none');
                document.getElementById('uploadPlaceholder').classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    const dropZone = document.getElementById('dropZone');
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#007bff';
    });
    dropZone.addEventListener('dragleave', function() {
        this.style.borderColor = '';
    });
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '';
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('foto').files = dt.files;
            document.getElementById('foto').dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush