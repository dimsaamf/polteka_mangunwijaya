<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukFarmasi extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_farmasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
    ];

    // public function inventarislabfarmakognosi()
    // {
    //     return $this->belongsTo(InventarislabFarmakognosi::class, 'id_barang');
    // }
    public function inventarisfarmasi()
    {
        return $this->belongsTo(InventarisFarmasi::class);
    }
}
