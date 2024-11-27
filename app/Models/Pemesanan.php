<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = "pemesanan";

    protected $fillable = ['barang_id', 'pelanggan_id', 'diskon_id', 'jumlah', 'total_harga'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }
}
