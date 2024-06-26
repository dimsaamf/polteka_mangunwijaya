<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukMikro extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_mikros';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabmikro()
    {
        return $this->belongsTo(InventarislabMikro::class, 'id_barang')
        ->withTrashed();
    }
}
