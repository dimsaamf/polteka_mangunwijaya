<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarKimiaOrganik extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_kimia_organiks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabkimiaorganik()
    {
        return $this->belongsTo(InventarisLabKimiaOrganik::class, 'id_barang')
        ->withTrashed();
    }
}
