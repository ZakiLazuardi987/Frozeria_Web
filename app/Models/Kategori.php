<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Relasi: Kategori memiliki banyak Barang
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }

    /**
     * Hitung jumlah barang dalam kategori ini
     */
    public function getJumlahBarangAttribute(): int
    {
        return $this->barangs()->count();
    }
}