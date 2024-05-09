<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukMikrobiologi extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_mikrobiologis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabmikrobiologi()
    {
        return $this->belongsTo(InventarisLabMikrobiologi::class, 'id_barang');
    }
}
