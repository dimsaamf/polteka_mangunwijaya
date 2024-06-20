<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukKimiaOrganik extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_kimia_organiks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabkimiaorganik()
    {
        return $this->belongsTo(InventarisLabKimiaOrganik::class, 'id_barang')
        ->withTrashed();
    }
}
