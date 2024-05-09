<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarKimiaTerapan extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_kimia_terapans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabkimiaterapan()
    {
        return $this->belongsTo(InventarisLabKimiaTerapan::class, 'id_barang');
    }
}
