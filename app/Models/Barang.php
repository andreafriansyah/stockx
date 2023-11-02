<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_barang',
        'nama',
        'detail',
        'harga_modal',
        'harga_jual',
        'foto',
        'jumlah'
    ];
    
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

    public function getFotoAttribute()
    {
        return asset('storage/' . $this->attributes['foto']);
    }

}
