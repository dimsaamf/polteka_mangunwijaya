<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukTekfarmasi extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_tekfarmasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabtekfarmasi()
    {
        return $this->belongsTo(InventarisLabTekfarmasi::class, 'id_barang')
        ->withTrashed();
    }
}
