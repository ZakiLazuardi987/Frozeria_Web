<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    /**
     * Dashboard - tampilkan semua barang dengan filter & pencarian
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // Filter pencarian nama
        if ($request->filled('search')) {
            $query->nama($request->search);
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->kategori($request->kategori_id);
        }

        $barangs      = $query->orderBy('nama_barang')->paginate(5)->withQueryString();
        $kategoris    = Kategori::orderBy('nama_kategori')->get();
        $totalBarang   = Barang::count();
        $totalKategori = Kategori::count();
        $stokMenipis   = Barang::stokMenipis()->count();
        $stokHabis     = Barang::stokHabis()->count();

        return view('barang.index', compact(
            'barangs',
            'kategoris',
            'totalBarang',
            'totalKategori',
            'stokMenipis',
            'stokHabis'
        ));
    }

    /**
     * Tampilkan form tambah barang baru
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.create', compact('kategoris'));
    }

    /**
     * Simpan barang baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'   => 'required|string|max:200',
            'kategori_id'   => 'required|exists:kategoris,id',
            'jumlah_stok'   => 'required|integer|min:0',
            'satuan'        => 'required|string|max:50',
            'stok_minimum'  => 'nullable|integer|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'harga_beli'    => 'nullable|numeric|min:0',
            'berat_ukuran'  => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], $this->validationMessages());

        $data = $validated;
        $data['stok_minimum'] = $data['stok_minimum'] ?? 0;
        $data['harga_beli']   = $data['harga_beli'] ?? 0;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail barang
     */
    public function show(Barang $barang)
    {
        $barang->load('kategori');
        return view('barang.show', compact('barang'));
    }

    /**
     * Tampilkan form edit barang
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update data barang di database
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang'   => 'required|string|max:200',
            'kategori_id'   => 'required|exists:kategoris,id',
            'jumlah_stok'   => 'required|integer|min:0',
            'satuan'        => 'required|string|max:50',
            'stok_minimum'  => 'nullable|integer|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'harga_beli'    => 'nullable|numeric|min:0',
            'berat_ukuran'  => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], $this->validationMessages());

        $data = $validated;
        $data['stok_minimum'] = $data['stok_minimum'] ?? 0;
        $data['harga_beli']   = $data['harga_beli'] ?? 0;

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        } else {
            // Pertahankan foto lama
            unset($data['foto']);
        }

        $barang->update($data);

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Hapus barang dari database
     */
    public function destroy(Barang $barang)
    {
        // Hapus foto jika ada
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Pesan validasi dalam Bahasa Indonesia
     */
    private function validationMessages(): array
    {
        return [
            'nama_barang.required'  => 'Nama barang wajib diisi.',
            'kategori_id.required'  => 'Kategori wajib dipilih.',
            'kategori_id.exists'    => 'Kategori yang dipilih tidak valid.',
            'jumlah_stok.required'  => 'Jumlah stok wajib diisi.',
            'jumlah_stok.integer'   => 'Jumlah stok harus berupa angka.',
            'jumlah_stok.min'       => 'Jumlah stok tidak boleh negatif.',
            'satuan.required'       => 'Satuan wajib diisi.',
            'harga_jual.required'   => 'Harga jual wajib diisi.',
            'harga_jual.numeric'    => 'Harga jual harus berupa angka.',
            'foto.image'            => 'File foto harus berupa gambar.',
            'foto.mimes'            => 'Format foto harus JPG atau PNG.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}