<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarMikrobiologi extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_mikrobiologis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabmikrobiologi()
    {
        return $this->belongsTo(InventarisLabMikrobiologi::class, 'id_barang');
    }
}
