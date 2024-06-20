<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarOptekkim extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_optekkims';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislaboptekkim()
    {
        return $this->belongsTo(InventarisLabOptekkim::class, 'id_barang')
        ->withTrashed();
    }
}
