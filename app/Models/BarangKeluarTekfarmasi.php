<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarTekfarmasi extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar_tekfarmasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
    ];

    public function inventarislabtekfarmasi()
    {
        return $this->belongsTo(InventarisLabTekfarmasi::class);
    }
}
