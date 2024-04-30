<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarFarmasi extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_farmasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
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
