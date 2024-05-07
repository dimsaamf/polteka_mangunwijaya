<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarAnkes extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_ankes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarisankes()
    {
        return $this->belongsTo(InventarisAnkes::class, 'id_barang');
    }
}
