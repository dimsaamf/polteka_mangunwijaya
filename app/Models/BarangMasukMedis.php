<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukMedis extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_medis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabmedis()
    {
        return $this->belongsTo(InventarisLabMedis::class);
    }
}
