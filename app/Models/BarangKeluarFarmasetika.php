<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarFarmasetika extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_farmasetikas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabfarmasetika()
    {
        return $this->belongsTo(InventarisLabFarmasetika::class, 'id_barang');
    }
}
