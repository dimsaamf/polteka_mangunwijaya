<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarMikro extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar_mikros';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabmikro()
    {
        return $this->belongsTo(InventarisLabMikro::class, 'id_barang');
    }
}
