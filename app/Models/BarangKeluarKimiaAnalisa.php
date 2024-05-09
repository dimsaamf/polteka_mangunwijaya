<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarKimiaAnalisa extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_kimia_analisas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabkimiaanalisa()
    {
        return $this->belongsTo(InventarisLabKimiaAnalisa::class, 'id_barang');
    }
}
