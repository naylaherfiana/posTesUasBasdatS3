<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";

    protected $fillable = ['nama_barang', 'stok', 'harga', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'pemesanan_id');
    }

    public function getByKategori($kategoriId)
    {
        $barang = Barang::where('kategori_id', $kategoriId)->get(['id', 'nama_barang']);
        return response()->json($barang);
    }
}
