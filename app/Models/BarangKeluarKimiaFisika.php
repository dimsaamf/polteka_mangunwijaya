<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarKimiaFisika extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_kimia_fisikas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabkimiafisika()
    {
        return $this->belongsTo(InventarisLabKimiaFisika::class, 'id_barang');
    }
}
