<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukFarmakognosi extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_farmakognosis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    // public function inventarislabfarmakognosi()
    // {
    //     return $this->belongsTo(InventarislabFarmakognosi::class, 'id_barang');
    // }
    public function inventarislabfarmakognosi()
    {
        return $this->belongsTo(InventarislabFarmakognosi::class, 'id_barang');
    }
}
