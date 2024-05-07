<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukAnkes extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_ankes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarisankes()
    {
        return $this->belongsTo(InventarisAnkes::class, 'id_barang');
    }
}
