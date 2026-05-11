<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'jumlah_stok',
        'satuan',
        'stok_minimum',
        'harga_jual',
        'harga_beli',
        'berat_ukuran',
        'lokasi_simpan',
        'deskripsi',
        'foto',
    ];

    protected $casts = [
        'jumlah_stok'  => 'integer',
        'stok_minimum' => 'integer',
        'harga_jual'   => 'decimal:2',
        'harga_beli'   => 'decimal:2',
    ];

    /**
     * Relasi: Barang dimiliki oleh satu Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Cek apakah stok habis
     */
    public function isStokHabis(): bool
    {
        return $this->jumlah_stok <= 0;
    }

    /**
     * Cek apakah stok menipis (di bawah stok minimum atau < 20)
     */
    public function isStokMenipis(): bool
    {
        return $this->jumlah_stok > 0 && $this->jumlah_stok < 20;
    }

    /**
     * Format harga jual ke Rupiah
     */
    public function getHargaJualFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    /**
     * Format harga beli ke Rupiah
     */
    public function getHargaBeliFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }

    /**
     * Scope: filter berdasarkan nama
     */
    public function scopeNama($query, string $keyword)
    {
        return $query->where('nama_barang', 'LIKE', "%{$keyword}%");
    }

    /**
     * Scope: filter berdasarkan kategori
     */
    public function scopeKategori($query, int $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    /**
     * Scope: stok menipis (kurang dari 20)
     */
    public function scopeStokMenipis($query)
    {
        return $query->where('jumlah_stok', '>', 0)->where('jumlah_stok', '<', 20);
    }

    /**
     * Scope: stok habis
     */
    public function scopeStokHabis($query)
    {
        return $query->where('jumlah_stok', '<=', 0);
    }
}