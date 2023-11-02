<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_barang',
        'jumlah',
        'harga_modal',
        'harga_jual',
        'tanggal',
        'type',
        'jumlah'
    ];

    protected $with = ['barang'];

    public function getHargaModalNewAttribute()
    {
        // Format the 'price' attribute as Rupiah
        return 'Rp ' . number_format($this->harga_modal, 0, ',', '.');
    }

    public function getHargaJualNewAttribute()
    {
        // Format the 'price' attribute as Rupiah
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    public function getKeuntunganFormatAttribute()
    {
        $keuntungan = ($this->harga_jual - $this->harga_modal) * $this->jumlah;
        return 'Rp ' . number_format($keuntungan, 0, ',', '.');
    }

    public function getKeuntunganAttribute()
    {
        $keuntungan = ($this->harga_jual - $this->harga_modal) * $this->jumlah;
        return $keuntungan;
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
