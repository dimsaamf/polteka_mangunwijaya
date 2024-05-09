<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukKimiaTerapan extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_kimia_terapans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabkimiaterapan()
    {
        return $this->belongsTo(InventarisLabKimiaTerapan::class, 'id_barang');
    }
}
