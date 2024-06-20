<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarMedis extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar_medis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabmedis()
    {
        return $this->belongsTo(InventarisLabMedis::class, 'id_barang')
        ->withTrashed();
    }
}
