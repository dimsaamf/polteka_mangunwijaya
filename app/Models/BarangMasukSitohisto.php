<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukSitohisto extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_sitohistos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabsitohisto()
    {
        return $this->belongsTo(InventarisLabSitohisto::class, 'id_barang');
    }
}
